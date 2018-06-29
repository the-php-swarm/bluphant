<?php

/**
 * Bluzelle Database Adapter
 *
 * Bluzelle is a Blockchain Database that works in a system of swarms, this
 * makes the availability, integrity, integrability and the consistency be
 * natural. This is a PHP Database Adapter for Bluzelle.
 *
 * @category   Database Adapter
 * @package    Bluphant
 * @author     Savio Resende <savio@savioresende.com.br>
 * @copyright  2018 Savio Resende
 * @license    MIT License https://mit-license.org/
 * @version    Release: beta
 */

namespace Bluphant;

use Bluphant\Interfaces\DatabaseAdapterInterface;
use Bluphant\Exceptions\NotImplementedException;
use WebSocket\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class BluphantAdapter implements DatabaseAdapterInterface
{
    /**
     * Fields:
     * [
     *     'db_uuid': string,
     *     'port': int,
     *     'methods': enum
     * ]
     *
     * @var array
     */
    protected $config;

    /**
     * @internal [ "key" => string, "value" => string ]
     *
     * @var array
     */
    protected $statement;

    /**
     * @var int
     */
    protected $request_id = 0;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    const KEYS = 'keys';

    /**
     * @var string
     */
    const READ = 'read';

    /**
     * @var string
     */
    const CREATE = 'create';

    /**
     * @var string
     */
    const UPDATE = 'update';

    /**
     * @var string
     */
    const DELETE = 'delete';

    /**
     * @param string $table
     * @param string $fetchStyle
     * @param string $cursorOrientation
     * @param string $cursorOffset
     * @return string|void
     */
    public function fetch(string $table, $fetchStyle = null, $cursorOrientation = null, $cursorOffset = null)
    {
        throw new NotImplementedException('Bluzelle does not support fetching all records at this time');
    }

    /**
     * @param string $table
     * @param string $fetchStyle
     * @param int $column
     * @return string|void
     */
    public function fetchAll(string $table, $fetchStyle = null, $column = 0)
    {
        throw new NotImplementedException('Bluzelle does not support fetching all records at this time');
    }

    /**
     * Specify the database credentials for connection
     *
     * @param string $address
     * @param int $port
     * @param $request_id
     *
     * @return void
     */
    public function __construct(
        string $address = '',
        int $port = null,
        int $request_id = 4
    ) {
        $this->request_id = $request_id;

        $this->config = compact('address', 'port');

        $this->client = new Client("ws://" . $this->config['address'] . ":" . $this->config['port']);

        $this->log_info = new Logger('BluphantAdapterInfo');
        $this->log_info->pushHandler(new StreamHandler('./bluphant-adapter.log', Logger::INFO));
    }

    /**
     * Executes the request against the network
     *
     * @param int $attempts
     *
     * @return string json
     */
    public function execute($attempts = 0)
    {
        // --
        $protobufDatabaseMsg = new \database_msg();

        // prepare header
        $protobufHeaderMsg = new \database_header();
        $protobufHeaderMsg->setDbUuid($this->config['db_uuid']);
        $protobufHeaderMsg->setTransactionId($this->request_id);
        $protobufDatabaseMsg->setHeader($protobufHeaderMsg);

//        $this->config['method'] = 'read';
        switch ($this->config['method']) {
            case self::READ:
                // prepare read message
                $protobufReadMsg = new \database_read();
//                $protobufReadMsg->setKey($this->statement['key']);
                $protobufReadMsg->setKey("1");
                $protobufDatabaseMsg->setRead($protobufReadMsg);
//                dd($protobufDatabaseMsg);
                break;
            case self::KEYS:
                // prepare keys message
                $protobufKeysMsg = new \database_empty();
                $protobufDatabaseMsg->setKeys($protobufKeysMsg);
                break;
            case self::CREATE:
                // prepare create message
                $protobufCreateMsg = new \database_create();
                $protobufCreateMsg->setKey($this->statement['key']);
                $protobufCreateMsg->setValue($this->statement['value']);
                $protobufDatabaseMsg->setCreate($protobufCreateMsg);
                break;
        }

        $data = base64_encode($protobufDatabaseMsg->serializeToString());

        $executionParams = [
            "bzn-api" => "database",
            "msg" => $data
        ];

        // --

        $this->log_info->info('Request statement (execution params): ', [$executionParams]);
        $this->log_info->info('Request statement (data): ', [$data]);

        $this->client->send(json_encode($executionParams));

        $result = $this->client->receive();
        $protobufResponse = new \database_response($result);

        $success = $protobufResponse->getSuccess();
//        dd($success);

        $this->log_info->info('Request result (success): ', [$success]);

        if($attempts > 0){
            throw new \Exception('Multiple attempts happening. This is being investigated.');
        }

        // TODO: this is to deal with the redirection response
//        if ($this->isLeaderResponse($result) && $attempts < 2) {
//            $attempts++;
//            return $this->execute($attempts);
//        }

        $result = json_decode($result, true);

        if (empty($success)) {
            $result['data'] = [];
        }

        // place the statement in the result preffering the result's data
        switch ($this->config['method']) {
            case self::READ:
                $result = array_merge($this->statement, $result['data']);
                break;
            case self::KEYS:
                $result = $result['data'];
                break;
        }

        return $result;
    }

    /**
     * @param string $table
     *
     * @return BluphantAdapter
     */
    public function keys($table)
    {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = self::KEYS;

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     * @param string $boolOperator
     *
     * @return BluphantAdapter
     */
    public function select($table, array $bind, $boolOperator = "AND")
    {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = self::READ;
        $this->statement = $bind;

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     *
     * @return BluphantAdapter
     */
    public function insert($table, array $bind)
    {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = self::CREATE;
        $this->statement = $bind;

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     * @param string $where
     *
     * @return BluphantAdapter
     */
    public function update($table, array $bind, $where = "")
    {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = self::UPDATE;
        $this->statement = $bind;

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     *
     * @return BluphantAdapter
     */
    public function delete($table, $bind)
    {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = self::DELETE;
        $this->statement = $bind;

        return $this;
    }

    /**
     * Verify if the result is pointing to a new leader
     *
     * @param string $result
     *
     * @return bool
     */
    private function isLeaderResponse(string $result)
    {
        $result = json_decode($result, true);

        if (isset($result['data']['leader-host'])) {
            $this->client = new Client(
                "ws://" . $result['data']['leader-host'] . ":" . $result['data']['leader-port']
            );
            return true;
        }

        return false;
    }

}