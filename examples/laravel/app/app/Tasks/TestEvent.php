<?php
/**
 * Created by PhpStorm.
 * User: savioresende
 * Date: 2018-05-18
 * Time: 9:43 PM
 */

namespace App\Tasks;

use Hhxsv5\LaravelS\Swoole\Task\Event;
class TestEvent extends Event
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function getData()
    {
        return $this->data;
    }
}