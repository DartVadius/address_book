<?php
/**
 * Created by PhpStorm.
 * User: dartvadius
 * Date: 24.01.18
 * Time: 21:44
 */

class testService extends baseService {
    public function __construct() {
        parent::__construct();
        echo 'Hi!';
    }
}