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
Muumuu\Client::configure([
    'endpoint' => 'MUUMUU DOMAIN API ENDPOINT',
    'token' => 'JWT TOKEN'
]);
$client = new Muumuu\Client();
$client->getCarts();

// or
$client = new Muumuu\Client([
    'endpoint' => 'MUUMUU DOMAIN API ENDPOINT',
    'token' => 'JWT TOKEN'
]);
$client->getCarts();
```

### Support APIs

```php
<?php
$client = new Muumuu\Client();

// without authentication
$client->getDomainMaster();           // GET /domain_master

// required authentication
$client->getCarts();                  // GET /carts
$client->calculate();                 // POST /calculate
```
