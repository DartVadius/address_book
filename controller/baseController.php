<?php

/**
 * baseController
 *
 * @author DartVadius
 */
class baseController {
    protected $pdo = null;
    protected $view;
    protected $title;
    public function __construct() {        
        $this->pdo = pdoLib::getInstance()->getPdo();
        $this->view = new ViewLib(get_class($this));
    }
}
