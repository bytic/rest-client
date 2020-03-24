<?php

use ByTIC\RestClient\Client\BaseClient;
use ByTIC\RestClient\Client\Configuration\Configuration;

require '../vendor/autoload.php';

$config = Configuration::getDefaultConfiguration()
    ->setHost('jsonplaceholder.typicode.com');

$client = new BaseClient(null, $config);
$response = $client->get('/todos/1');

var_dump($response);
