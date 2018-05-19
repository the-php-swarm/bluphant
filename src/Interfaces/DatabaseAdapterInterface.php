<?php

/**
 * Interface DatabaseAdapterInterface
 *
 * TODO: add standard DocBlock (https://pear.php.net/manual/en/standards.header.php)
 */

namespace Bluphant\Interfaces;

interface DatabaseAdapterInterface
{
    /**
     * @param string $table
     * @param string $fetchStyle
     * @param string $cursorOrientation
     * @param string $cursorOffset
     * @return string json
     */
    public function fetch(string $table, $fetchStyle = null, $cursorOrientation = null, $cursorOffset = null);

    /**
     * @param string $table
     * @param string $fetchStyle
     * @param int $column
     * @return string json
     */
    public function fetchAll(string $table, $fetchStyle = null, $column = 0);

    /**
     * @return void
     */
    public function execute();

    /**
     * @param $table
     * @param array $bind
     * @param string $boolOperator
     * @return string json
     */
    public function select($table, array $bind, $boolOperator = "AND");

    /**
     * @param $table
     * @param array $bind
     * @return string json
     */
    public function insert($table, array $bind);

    /**
     * @param $table
     * @param array $bind
     * @param string $where
     * @return string json
     */
    public function update($table, array $bind, $where = "");

    /**
     * @param $table
     * @param array $bind
     * @return string json
     */
    public function delete($table, array $bind);

    /**
     * @param $table
     * @return string json
     */
    public function keys($table);
}