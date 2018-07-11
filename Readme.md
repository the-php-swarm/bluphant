# Bluphant

[![Build Status](https://travis-ci.org/the-php-swarm/bluphant.svg?branch=master)](https://travis-ci.org/the-php-swarm/bluphant)
[![License](https://img.shields.io/badge/License-Apache%202.0-blue.svg)](https://opensource.org/licenses/Apache-2.0)

(This is the original, but I recommend to use this fork: https://github.com/bluzelle/bluzelle-php)

Bluphant is a PHP library to interact with Bluzelle Blockchain Database.

Bluzelle is a Blockchain Database that works in a system of swarms, this makes the availability, integrity, integrability and the consistency be natural. This is a PHP Database Adapter for Bluzelle.

There is a sample here that is the existent ``example`` in this package built with ``docker-compose``: 

> [Sample](https://swarm.masa.tech)

## Usage

Before everything, Bluphant is an Adapter, and to use it you just have to place it as an $adapter for you Database Layer.

It might be interesting to build other 2 classes to work with this:

- Data Mapper

  ```php
  $userMapper = new UserMapper($adapter);
  ```

- Models

  ```php
  $user = new User("Everchanging Joe", "joe@example.com");
  $userMapper->insert($user);
  ```

---

# How to

## Installation

### Using Composer

```json
composer require bluzelle/bluzelle-php
```

Because of the necessary support to **[protobuf](https://developers.google.com/protocol-buffers/)**, a required step to use this library is to install a PECL package through this command:

```shell
sudo pecl install protobuf-3.5.1
```

## Prepare Adapter

```php
use Bluphant\BluphantAdapter;

$adapter = new BluphantAdapter('127.0.0.1', 8100);

$table = '3f966cd1-ef79-4464-b3be-81e84002550b';
```

## Statements

### Create

```php
$adapter->insert($table, [
    "key" => "key1",
    "value" => "sample value"
]);
```

### Read

```php
$adapter->select($table, [
    "key" => "key1"
]);
```

### Update

```php
$adapter->update($table, [
    "key" => "key1",
    "value" => "sample value 2"
]);
```

### Delete

```php
$adapter->delete($table, [
    "key" => "key1"
]);
```

### Keys

```php
$adapter->keys($table);
```

### Execute

```php
echo $adapter->execute();
```

---

## Reference

- [Bluzelle WebSocket API](https://bluzelle.github.io/api/#websocket-api)


---

## Protobuf

There is a build step of this library for protobuf. This will be required so it accomplished the goal of Bluzelle project, which is to have a better environment for development and business.

During the build step, that is not required for someone that is simply using this library, is to run this at the root directory of this library:

```shell 
protoc --proto_path=src/Datastructure --php_out=./src/Datastructure Database.proto
```
