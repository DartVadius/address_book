<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 24.01.18
 * Time: 21:47
 */

class baseService {
    protected $pdo = null;

    public function __construct() {
        $this->pdo = pdoLib::getInstance()->getPdo();
    }
}