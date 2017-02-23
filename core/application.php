<?php

class Application {
   
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (action) */
    private $url_action = null;

    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct() {        
        set_exception_handler(array(get_class($this), "getStaticException"));
        session_start();
    }
    
    public function run() {        
        $this->splitUrl();        
        if (!$this->url_controller) {
            $page = new IndexController();
            $page->indexAction();
        } elseif (file_exists(ROOT . 'controller/' . $this->url_controller . '.php')) {            
            $this->url_controller = new $this->url_controller();            
            if (method_exists($this->url_controller, $this->url_action)) {
                if (!empty($this->url_params)) {                    
                    call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                } else {                    
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) == 0) {                    
                    $this->url_controller->indexAction();
                } else {
                    throw new Exception('Page not found', 404);
                }
            }
        } else {
            throw new Exception('Page not found', 404);
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl() {
        if (isset($_GET['url'])) {
            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);            
            $this->url_controller = isset($url[0]) ? ucwords($url[0]) . 'Controller' : null;
            $this->url_action = isset($url[1]) ? $url[1] . 'Action' : null;            
            unset($url[0], $url[1]);            
            $this->url_params = array_values($url);            
        }
    }
    
    public static function getStaticException($exception) {
        $exceptionHandlerClass = "errorController";
        $exceptionHandlerClass = new $exceptionHandlerClass();
        $exceptionHandlerClass->error($exception);
    }

}
