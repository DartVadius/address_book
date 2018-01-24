<?php
/**
 * indexController
 *
 * @author DartVadius
 */
class indexController extends baseController {

    public function indexAction() {
        $param = [
            ['index/index', []]
        ];
        $this->view->render($param);
    }    

}
