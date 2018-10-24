<?php

require_once './vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class Users {
    protected $database; 
    protected $dbname = 'users'; 

    public function __construct() {
        $acc = ServiceAccount::fromJsonFile(__DIR__.'/secret/php-tutorial-efd9d-33598b7ecb95.json');
        $firebase = (new Factory)->withServiceAccount($acc)->create();  

        $this->database = $firebase->getDatabase(); 
    }

    public function get(int $userID = NULL) {
        if(empty($userID) || !isset($userID)) {
            return FALSE; 
        }
        if($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)) {
            return $this->database->getReference($this->dbname)->getChild($userID)->getValue();  
        } else {
            return FALSE; 
        }
    }

    // 'insert' method used on existing userID will overwrite its respective data!
    // No specific work around just yet, proceed with caution! 
    // 10/23/18 
    public function insert(array $data) {
        if(empty($data) || !isset($data)) {
            return FALSE; 
        }

        foreach ($data as $key => $value){
            $this->database->getReference()->getChild($this->dbname)->getChild($key)->set($value);  
        }

        return TRUE; 
        
    }

    public function delete(int $userID) {
        if(empty($userID) || !isset($userID)) {
            return FALSE; 
        }
        if($this->database->getReference($this->dbname)->getSnapshot()->hasChild($userID)){
            $this->database->getReference($this->dbname)->getChild($userID)->remove();
            return TRUE;  
        } else {
            return FALSE; 
        }
        
    }
}

$users = new Users(); 

// Insert an array to firebase

// var_dump($users->insert([
//     '1' => 'John', 
//     '2' => 'Elijah', 
//     '3' => 'Peter'
// ]));

// Gets data from firebase using their respective userID as an argument

// var_dump($users->get(2));  

// var_dump($users->delete(2));

var_dump($users->insert(['2' => 'Les Paul'])); 

// -------------------------------------------------------------[ NOTES ]--------------------------------------------------------------------

// 1. Planning: Without the perfect plan, calculating the strengths and weaknesses of the project, development of software is meaningless. 
// Planning kicks off a project flawlessly and affects its progress positively.

// 2. Analysis: This step is about analyzing the performance of the software at various stages and making notes on 
// additional requirements. Analysis is very important to proceed further to the next step.

// 3. Design: Once the analysis is complete, the step of designing takes over, which is basically building the 
// architecture of the project. This step helps remove possible flaws by setting a standard and attempting to stick to it.

// 4. Development & Implementation: The actual task of developing the software starts here with data 
// recording going on in the background. Once the software is developed, the stage of implementation comes in where the 
// product goes through a pilot study to see if it’s functioning properly.

// 5. Testing: The testing stage assesses the software for errors and documents bugs if there are any.

// 6. Maintenance: Once the software passes through all the stages without any issues, it is to 
// undergo a maintenance process wherein it will be maintained and upgraded from time to time to adapt to changes. 
