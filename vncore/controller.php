<?php
class Controller extends View {
    protected $param_main;
    
    /**
     * Construct
     * 
     * create param data
     */
    //public function __construct() {
        
    //}
    
    public function init() {
        
    }
    
    protected function loading() {
        spl_autoload_register(array($this, 'loader'));
    }
    
    /**
     * get param
     * @param array $arr
     * @return array |NULL
     */
    public function get_param($arr) {
        if(count($arr) > 0 && count($_REQUEST) > 0) {
            $arr_result = array();
            foreach ($arr as $key) {
                foreach ($_REQUEST as $key_p => $val_p) {
                    if($key == $key_p) {
                        $arr_result[$key] = $val_p;
                    }
                }
            }
            
            return $arr_result;
        } else {
            return NULL;
        }
    }
    
    /**
     * set param
     * use when you call diff action
     * @param array $param
     */
    public function set_param($param) {
        $_REQUEST = $param;
    }
    
    public function main() {
        $this->loading();
        
        $param_action = Core::validate_action();
        
        //_Controller  ucfirst(strtolower($bar));
        $controller = strtolower($param_action['controller'])."_Controller";
        $action = strtolower($param_action['action']);
        // url friendly region start
        
        $url_fctl = "URLFriend";
        if(class_exists($url_fctl)) {
            $murl = new URLFriend();
            $checkurl = $murl->checkurl();
            $controller = count($checkurl['controller']) > 0 ? ucfirst($checkurl['controller']) . "_Controller" : $controller;
            $action = count($checkurl['controller']) > 0 ? ucfirst($checkurl['action']) : $action;
        }
        
        // url friendly region end
        if(class_exists($controller)) {
            $controler = new $controller();
            $controler->init();// installcontroller
            
            call_user_func(array($controler, $action));
        } else {
            //error
            echo $controller . ': not found';
        }
    }
    
    protected function loader($class_name)
    {
        $class_name = mb_strtolower($class_name);
        
        $name = explode('_', $class_name);

        $r_name = array_reverse($name);

        $dir = implode('/', $r_name);

        $dir_all = VN_APP_DIR . '/' . $dir . '.php';

        if (file_exists($dir_all)) {
            require_once $dir_all;
        }
    }
}