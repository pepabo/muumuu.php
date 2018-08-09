# muumuu.php

API Client for MuumuuDomain.

[![Build Status](https://travis-ci.org/pepabo/muumuu.php.svg?branch=master)](https://travis-ci.org/pepabo/muumuu.php)

## Installation

```console
$ composer require muumuu-domain/muumuu.php
```

## Usage

```php
<?php
require_once 'vendor/autoload.php';

Muumuu\Client::configure([
    'endpoint' => 'MUUMUU DOMAIN API ENDPOINT',
]);

$client = new Muumuu\Client();
$response = $client->getDomainMaster();

$response->statusCode();  // 200
$response->body();        // JSON body
```

Possible to specify it with constructor arguments.

```php
<?php
$client = new Muumuu\Client([
    'endpoint' => 'MUUMUU DOMAIN API ENDPOINT',
]);
$response = $client->getDomainMaster();
$response->body();
```

Authentication with JWT.

```php
<?php
$client = new Muumuu\Client();
if ($client->authenticate('id' /* muumuu id */, 'password' /* login password */)) {
    $client->getCarts();
}

// get token
$client = new Muumuu\Client();
if ($client->authenticate('id', 'password')) {
    $token = $client->getToken();
}

// set token
$client = new Muumuu\Client();
$client->setToken($token);
$client->getCarts();
```

### Support APIs

```php
<?php
$client = new Muumuu\Client();

// authenticate
$client->authenticate('id', 'password');  // POST /authenticate
$client->me();                            // GET /me

// without authentication
$client->getDomainMaster();               // GET /domain_master

// required authentication
$client->getCarts();                      // GET /carts
$client->calculate([]);                   // POST /calculate
$client->createWordpress([]);             // POST /wordpress
```
