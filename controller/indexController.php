<?php

/**
 * indexController
 *
 * @author DartVadius
 */
class indexController extends baseController {

    public function indexAction() {        
        header("Location: /user/index");
    }    

}
