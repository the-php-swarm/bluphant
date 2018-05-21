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

Once Swoole is installed, run:

```
php artisan swoole:http {start|stop|restart|reload|infos}
```


