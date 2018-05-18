# Bluphant

Bluphant is a PHP library to interact with Bluzelle Blockchain Database.

Bluzelle is a Blockchain Database that works in a system of swarms, this makes the availability, integrity, integrability and the consistency be natural. This is a PHP Database Adapter for Bluzelle.

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

## Challenges

Since Bluzelle is a **key-value** database, the application, to start using this solution, might change a little bit its processes to fit.

---

# How to

## Installation

### Using Composer

```json
{
  "repositories": [
    {
      "url": "https://github.com/the-php-swarm/bluphant.git",
      "type": "vcs"
    }
  ],
  "require": {
    "the-php-swarm/bliphant": "beta"
  }
}
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

