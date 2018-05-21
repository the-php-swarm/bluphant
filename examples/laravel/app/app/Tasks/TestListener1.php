<?php
/**
 * Created by PhpStorm.
 * User: savioresende
 * Date: 2018-05-18
 * Time: 9:49 PM
 */

namespace App\Tasks;

use Hhxsv5\LaravelS\Swoole\Task\Event;
use Hhxsv5\LaravelS\Swoole\Task\Listener;

class TestListener1 extends Listener
{
    // Declare constructor without parameters
    public function __construct()
    {

    }

    public function handle(Event $event)
    {
        \Log::info(__CLASS__ . ':handle start', [$event->getData()]);
        sleep(10);// Simulate the slow codes
        // throw new \Exception('an exception');// all exceptions will be ignored, then record them into Swoole log, you need to try/catch them
        \Log::info(__CLASS__ . ':handle start2', [$event->getData()]);
    }
}