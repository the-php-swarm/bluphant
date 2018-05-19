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
     * @var
     */
    protected $config;

    /**
     * @internal [ "key" => string, "value" => string ]
     *
     * @var
     */
    protected $statement;

    /* @var */
    protected $request_id;

    /* @var */
    protected $client;

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
    }

    /**
     * Executes the request against the network
     *
     * @return string json
     */
    public function execute()
    {
        $execution_params = [
            "bzn-api" => "crud",
            "cmd" => $this->config['method'],
            "data" => $this->statement,
            "db-uuid" => $this->config['db_uuid'],
            "request-id" => $this->request_id
        ];

        $this->client->send(json_encode($execution_params));

        return $this->client->receive();
    }

    /**
     * @param string $table
     *
     * @return BluphantAdapter
     */
    public function keys($table){
        $this->config['db_uuid'] = $table;
        $this->config['method'] = 'keys';

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     * @param string $boolOperator
     *
     * @return BluphantAdapter
     */
    public function select($table, array $bind, $boolOperator = "AND") {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = 'read';
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
        $this->config['method'] = 'create';
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
    public function update($table, array $bind, $where = "") {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = 'update';
        $this->statement = $bind;

        return $this;
    }

    /**
     * @param string $table
     * @param array $bind
     *
     * @return BluphantAdapter
     */
    public function delete($table, $bind) {
        $this->config['db_uuid'] = $table;
        $this->config['method'] = 'delete';
        $this->statement = $bind;

        return $this;
    }

}