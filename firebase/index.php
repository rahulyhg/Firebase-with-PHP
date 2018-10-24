<?php   

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this PHP file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/secret/php-tutorial-efd9d-33598b7ecb95.json');

// C:\xampp\htdocs\firebase\secret\php-tutorial-efd9d-33598b7ecb95.json

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();

die(print_r($database)); 