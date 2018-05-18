<?php

/**
 * Bluzelle Database Adapter Unit Tests
 *
 * Before Testing, it must have:
 *
 *     - Swarm JS Client (https://github.com/bluzelle/swarmclient-js),
 *       running with the command "node Emulator"
 *
 * @package    Bluphant
 * @author     Savio Resende <savio@savioresende.com.br>
 * @copyright  2018 Savio Resende
 * @license    MIT License https://mit-license.org/
 * @version    Release: beta
 */

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Bluphant\BluphantAdapter;

final class BluphantAdapterTest extends TestCase
{
    /* @var */
    protected $adapter;

    /* @var */
    protected $table;

    /**
     * Here is interesting to make available the
     * database emulator at least.
     *
     * @before
     */
    public function setUpConnetion()
    {
        $this->adapter = new BluphantAdapter(
            '127.0.0.1',
            8100
        );

        $this->table = '3f966cd1-ef79-4464-b3be-81e84002550b';
    }

    /**
     * $depends setUpConnetion
     */
    public function testRegisterCreation(): void
    {
        $this->adapter->insert($this->table, [
            "key" => "key1",
            "value" => "sample value"
        ]);

        $result = $this->adapter->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterRetrieval(): void
    {
        $this->adapter->select($this->table, [
            "key" => "key1"
        ]);

        $result = $this->adapter->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterUpdate(): void
    {
        $this->adapter->update($this->table, [
            "key" => "key1",
            "value" => "sample value 2"
        ]);

        $result = $this->adapter->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterDelete(): void
    {
        $this->adapter->delete($this->table, [
            "key" => "key1"
        ]);

        $result = $this->adapter->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegistersKeys(): void
    {
        $this->adapter->keys($this->table);

        $result = $this->adapter->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }
}