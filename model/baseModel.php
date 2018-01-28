<?php

/**
 * baseModel
 *
 * @author DartVadius
 */
class baseModel {
    protected $pdo = null;
    public function __construct() {
        $this->pdo = pdoLib::getInstance()->getPdo();
    }
}
