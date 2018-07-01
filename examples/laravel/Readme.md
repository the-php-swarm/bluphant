# Reference

**Reference for Swoole with Laravel**: https://github.com/swooletw/laravel-swoole/wiki

## How To

### Step 1

Install Swoole in your environment

### Step 2

Run:

```shell
cd examples/laravel/app
composer install
```

### Step 3

Access [Swarm Client](https://github.com/bluzelle/swarmclient-js) repository and put Emulator to work (Usually this happens by, at the swarm client's directory, navigating to the _emulator's_ directory and running ``node Emulator.js`` - having **nodejs** also installed in your environment).

Add this (following informations for the Bluzelle Emulator):

```
# Address for connection to Bluzelle Swarm
BLUZELLE_ADDRESS=127.0.0.1
BLUZELLE_PORT=8100
```

### Step 4

Confirm the configuration at your composer.json, more specifically, the autoload attribute, it should look something close to this:

```json
"autoload": {
    ...
    "files": [
        "database_create.php",
        "database_delete.php",
        "database_empty.php",
        "database_has.php",
        "database_header.php",
        "database_msg.php",
        "database_read.php",
        "database_redirect_response.php",
        "database_response.php",
        "database_response_response.php",
        "database_update.php"
    ],
    "psr-4": {
        ...
        "GPBMetadata\\": "GPBMetadata/"
    }
},
```

---

## Swoole Server

Install packages:

```shell
composer require hhxsv5/laravel-s
```

or

```shell
composer require swooletw/laravel-swoole
```

Once Swoole is installed, run:

```
php artisan swoole:http {start|stop|restart|reload|infos}
```


