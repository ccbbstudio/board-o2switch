<?php

/**
 * Database
 */
class DB extends PDO {
 
    private static $_instance;
 
    public function __construct( ) {
  
    }
 
    public static function getInstance() {
     
        if (!isset(self::$_instance)) {
             
            try {
             
                self::$_instance =  new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';', DB_USER, DB_PASSWORD);
             
            } catch (PDOException $e) {
             
                echo $e;
            }
        }
        return self::$_instance;
    }
}