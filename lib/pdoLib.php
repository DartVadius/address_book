<?php

/**
 * pdoLib
 *
 * @author DartVadius
 */
final class pdoLib {

    private $pdo;
    
    public static function getInstance() {
        static $inst = null;
        if ($inst === null) {
            $inst = new PDOLib();
        }
        return $inst;
    }

    public function getPDO() {
        return $this->pdo;
    }
    private function __construct() {        
        $dsn = "mysql:host=localhost;dbname=registration;charset=utf8";
        $opt = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, 'root', '', $opt);        
    }

    private function __clone() {
        
    }
    
    private function __sleep() {
        
    }
    
    private function __wakeup() {
        
    }

}
