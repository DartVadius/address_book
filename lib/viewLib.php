<?php

/**
 * render
 *
 * @author DartVadius
 */
class viewLib {

    private $viewPath;
    private $layout;

    public function __construct($className) {
        preg_match_all('/[A-Z][^A-Z]*/', $className, $results);
        $controllerFolder = strtolower(current($results[0]));
        $this->viewPath = ROOT . 'view/' . $controllerFolder . '/';
        $this->layout = ROOT . 'view/layout/layout.php';
    }

    private function getTemplateContent($template, $params = []) {
        extract($params);
        ob_start();
        $pathToTemplate = ROOT . 'view/' . $template . '.php';
        if (file_exists($pathToTemplate)) {
            require_once $pathToTemplate;
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    public function render($array) {
        $content = array();
        foreach ($array as $temp) {
            $template = $temp[0];
            $params = $temp[1];
            array_push($content, $this->getTemplateContent($template, $params));
        }
        if (file_exists($this->layout)) {
            require_once $this->layout;
        }
    }

    public function renderPartial($template, $params = []) {
        echo $this->getTemplateContent($template, $params);
    }

}
