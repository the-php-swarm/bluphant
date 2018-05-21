<?php

namespace App\Model\Mapper;

use Bluphant\Interfaces\DatabaseAdapterInterface;
use App\Model\Interface\NoteInterface;
use App\Model\Interface\NoteMapperInterface;
use App\Model\Note;

class NoteMapper extends AbstractDataMapper implements NoteMapperInterface
{
    protected $entityTable = config('database.connections.bluphant.address_base') . "-notes";

    /**
     * @param DatabaseAdapterInterface $adapter
     * 
     * @return void
     */
    public function __construct(DatabaseAdapterInterface $adapter) {
        parent::__construct($adapter);
    }

    /**
     * @param NoteInterface $note
     * 
     * @return string $key
     */
    public function insert(NoteInterface $note) {
        $note->key = $this->adapter->insert(
            $this->entityTable,
            [
                "title"   => $note->title,
                "content" => $note->content
            ]
        );

        return $note->key;
    }

    /**
     * @param int|NoteInterface $key
     * 
     * @return bool
     */
    public function delete($key) {
        if ($key instanceof NoteInterface) {
            $key = $key->key;
        }

        return $this->adapter->delete($this->entityTable, $key);
    }

    /**
     * @param array $data
     * 
     * @return Note
     */
    protected function createEntity(array $data) {
        return new Note("", $data["title"], $data["content"]);
    }
}