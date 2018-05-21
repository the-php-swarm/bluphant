<?php

namespace App\Model\Mapper;

use Bluphant\Interfaces\DatabaseAdapterInterface;
// use Bluphant\Exceptions\NotImplementedException;

abstract class AbstractDataMapper
{
    protected $adapter;
    protected $entityTable;

    /**
     * @param DatabaseAdapterInterface $adapter
     * 
     * @return void
     */
    public function __construct(DatabaseAdapterInterface $adapter) {
        $this->adapter = $adapter;
    }

    /**
     * @return DatabaseAdapterInterface
     */
    public function getAdapter() {
        return $this->adapter;
    }

    /**
     * @param string $key
     * 
     * @return
     */
    public function findById($key)
    {
        // throw new NotImplementedException('Bluzelle does not support fetching all records at this time');
    }

    /**
     * @param array $conditions
     * 
     * @return
     */
    public function findAll(array $conditions = array())
    {
        // throw new NotImplementedException('Bluzelle does not support fetching all records at this time');
    }

    /**
     * @param array $data
     * 
     * @return Note
     */
    abstract protected function createEntity(array $data);
}