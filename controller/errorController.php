<?php

/**
 * ErrorController
 *
 * @author DartVadius
 */
class errorController extends baseController {

    public function error($exception = '') {
        $param = array();
        if ($exception->getCode() == 404) {
            $param = array (                
                ['error/error', ['exception' => $exception]]
            );
            $this->view->render($param);
        }
    }

}
