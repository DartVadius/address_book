<?php

/**
 * indexController
 *
 * @author DartVadius
 */
class indexController extends baseController {

    public function indexAction() {
        $service = new testService();
        $param = [
            ['index/index', []]
        ];
        $this->view->render($param);
    }

}
