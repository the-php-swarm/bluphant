# Reference

**Reference for Swoole with Laravel**: https://github.com/swooletw/laravel-swoole/wiki

## How To

### Step 1:

Install Swoole in your environment

### Step 2:

Access [Swarm Client](https://github.com/bluzelle/swarmclient-js) repository and put Emulator to work.

Add this (following informations for the Bluzelle Emulator):

```
# Address for connection to Bluzelle Swarm
BLUZELLE_ADDRESS=127.0.0.1
BLUZELLE_PORT=8100
```

### Step 3:

Once Swoole is installed, run:

```
php artisan swoole:http {start|stop|restart|reload|infos}
```


