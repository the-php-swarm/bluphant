<?php

/**
 * Interface DatabaseAdapterInterface
 *
 * TODO: add standard DocBlock (https://pear.php.net/manual/en/standards.header.php)
 */

namespace Bluphant\Interfaces;

interface DatabaseAdapterInterface
{
    // TODO
    // public function fetch($fetchStyle = null, $cursorOrientation = null, $cursorOffset = null);
    // public function fetchAll($fetchStyle = null, $column = 0);

    public function execute();
    public function select($table, array $bind, $boolOperator = "AND");
    public function insert($table, array $bind);
    public function update($table, array $bind, $where = "");
    public function delete($table, array $bind);
    public function keys($table);
}