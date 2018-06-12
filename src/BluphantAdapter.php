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
        $execution_params = [
            "bzn-api" => "crud",
            "cmd" => $this->config['method'],
            "data" => $this->statement,
            "db-uuid" => $this->config['db_uuid'],
            "request-id" => $this->request_id
        ];

        $this->log_info->info('Request statement: ', $execution_params);

        $this->client->send(json_encode($execution_params));

        $result = $this->client->receive();

        $this->log_info->info('Request result: ', [$result]);

        if($attempts > 0){
            throw new \Exception('Multiple attempts happening. This is being investigated.');
        }

        if ($this->isLeaderResponse($result) && $attempts < 2) {
            $attempts++;
            return $this->execute($attempts);
        }

        $result = json_decode($result, true);

        if (!isset($result['data']) || $result['data'] === null) {
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