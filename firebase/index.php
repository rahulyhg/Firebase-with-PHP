<?php   

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// This assumes that you have placed the Firebase credentials in the same directory
// as this php file.
$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/secret/php-tutorial-efd9d-33598b7ecb95.json');

// C:\xampp\htdocs\firebase\secret\php-tutorial-efd9d-33598b7ecb95.json

$firebase = (new Factory)
    ->withServiceAccount($serviceAccount)
    ->create();

$database = $firebase->getDatabase();

// 10/24/18 - What does this do? Notice how it can be commented out like this. Firebase connection works just as well. 
// die(print_r($database)); 
