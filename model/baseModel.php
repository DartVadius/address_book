<?php

/**
 * baseModel
 *
 * @author DartVadius
 */
class baseModel {
    public static $pdo = null;
    public function __construct() {
        $this->pdo = pdoLib::getInstance()->getPdo();
    }
}
