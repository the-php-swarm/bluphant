<?php

namespace App\Model\Interface;

interface NoteMapperInterface 
{
	/**
	 * Find Records by Id
	 * 
	 * @param int $key 
	 */
	public function findById($key);

	/**
	 * Find All Records by some filters
	 * 
	 * @param array $conditions
	 */
	public function findAll(array $conditions = array());

	/**
	 * Persist a record
	 * 
	 * @param NoteInterface $note
	 */
	public function insert(NoteInterface $note);

	/**
	 * Delete a Record
	 * 
	 * @param int $key
	 */
	public function delete($key);
}