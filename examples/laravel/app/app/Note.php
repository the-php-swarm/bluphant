<?php

namespace App;

class Note 
{
	/**
	 * @var string
	 */
	protected $key;

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $content;

	/**
	 * @param string $key
	 * @param string $title
	 * @param string $content
	 * 
	 * @return Note
	 */
	public function __construct(string $key, string $title, string $content)
	{
		$this->key = $key;
		$this->title = $title;
		$this->content = $content;

		return $this;
	}

	/**
	 * @param string $name
	 * @param string $value
	 * 
	 * @return void
	 */
	public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @param string $name
     * 
     * @return mix
     */
    public function __get($name)
    {
    	if (!isset($this->{$name})) {
    		return null;
    	}

        return $this->{$name};
    }

}