# muumuu.php

API Client for MuumuuDomain.

[![Build Status](https://travis-ci.org/pepabo/muumuu.php.svg?branch=master)](https://travis-ci.org/pepabo/muumuu.php)

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
