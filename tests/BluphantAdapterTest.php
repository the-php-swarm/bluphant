<?php

/**
 * Bluzelle Database Adapter Unit Tests
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
    protected $bluphantAdapterMock;

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
        $this->bluphantAdapterMock = $this->getMockBuilder('Bluphant\BluphantAdapter')
            ->setConstructorArgs(['127.0.0.1', 8100])
            ->getMock();

        $this->table = '3f966cd1-ef79-4464-b3be-81e84002550b';
    }

    /**
     * $depends setUpConnetion
     */
    public function testRegisterCreation(): void
    {
        $this->bluphantAdapterMock->expects($this->once())
            ->method('insert')
            ->will($this->returnValue($this->bluphantAdapterMock));

        $this->bluphantAdapterMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue('{"request-id": 4}'));

        $result = $this->bluphantAdapterMock->insert($this->table, [
            "key" => "key1",
            "value" => "sample value"
        ])->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterRetrieval(): void
    {
        $this->bluphantAdapterMock->expects($this->once())
            ->method('select')
            ->will($this->returnValue($this->bluphantAdapterMock));

        $this->bluphantAdapterMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue('{"data" : {"key":"key1"},"request-id" : 4}'));

        $result = $this->bluphantAdapterMock->select($this->table, [
            "key" => "key1"
        ])->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterUpdate(): void
    {
        $this->bluphantAdapterMock->expects($this->once())
            ->method('update')
            ->will($this->returnValue($this->bluphantAdapterMock));

        $this->bluphantAdapterMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue('{"request-id": 4}'));

        $result = $this->bluphantAdapterMock->update($this->table, [
            "key" => "key1",
            "value" => "sample value 2"
        ])->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegisterDelete(): void
    {
        $this->bluphantAdapterMock->expects($this->once())
            ->method('delete')
            ->will($this->returnValue($this->bluphantAdapterMock));

        $this->bluphantAdapterMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue('{"request-id": 4}'));

        $result = $this->bluphantAdapterMock->delete($this->table, [
            "key" => "key1"
        ])->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }

    /**
     * @depends testRegisterCreation
     */
    public function testRegistersKeys(): void
    {
        $this->bluphantAdapterMock->expects($this->once())
            ->method('keys')
            ->will($this->returnValue($this->bluphantAdapterMock));

        $this->bluphantAdapterMock->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(
                '{"data": {"keys": ["key1", "key2"]},"request-id": 4}'
            ));

        $result = $this->bluphantAdapterMock->keys($this->table)->execute();

        $this->assertTrue(json_decode($result) !== null);
        $this->assertArrayHasKey('request-id', json_decode($result, true));
        $this->assertFalse(isset(json_decode($result, true)['error']));
    }
}