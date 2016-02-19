<?php
class Core {
    
    public static  $param_action;
    public static  $param_data;
    public static $base_url;

    // validate action
    public static function validate_action() {
        $hbaction = explode('/', $_REQUEST['hbaction']);
        
        $param_action = array();
        $param_action['controller'] = '';
        $param_action['action'] = 'Index';
        if(isset($hbaction[0]))
            $param_action['controller'] = Validate::action_name_check($hbaction[0]);
        if(isset($hbaction[1]))
            $param_action['action'] = Validate::action_name_check($hbaction[1]);
        
        //get action default
        if(empty($param_action['controller'])) {
            $param_action = Core::get_action_default();
        }
        
        if(count($hbaction) > 2) {
            $r_for = count($hbaction);
            for ($i = 2; $i < $r_for; $i++) {
                $param_action['data'][] = $hbaction[$i];
            }
        }
        
        if($param_action['action'] == '') {
            $param_action['action'] = 'Index';
        }
        
        return $param_action;
    }
    
    // validate input function
    private function validate_data() {
        $tmp = $_REQUEST;
        unset($tmp['hbaction']);
        return $tmp;
    }
    
    public static function get_action_default() {
        
        // call action default from db
        
        
        //action default of system
        $param_action['controller'] = 'index';
        $param_action['action'] = 'Index';
        return $param_action;
    }
    
    public function loader() {
        
        Core::load_all(WEB_DIR."/app");

    }
    
    /**
     *  Load all file .php
     * @param $dir
     */
    public function load_all($dir) {
        $files = scandir($dir);
        if(count($files) > 0) {
            foreach ($files as $file) {
                if($file != '.' && $file != '..' && $file != 'view') {
                    $ext = pathinfo($file, PATHINFO_EXTENSION);
                    if($ext == 'php') {
                        require_once $dir."/".$file;
                    } else if($ext == '') {
                        Core::load_all($dir."/".$file);
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * set base url
     */
    public static function set_base_url() {
        $root = null;
        if($_SERVER["SERVER_PORT"] == 80) {
            $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        } else {
            $root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .':'.$_SERVER["SERVER_PORT"] . $_SERVER['PHP_SELF'];
        }
        
        $root_tmp = explode("/index.php", $root);
        Core::$base_url = $root_tmp[0].'/';
    }
    
    /**
     * get base url
     */
    public static function base_url() {
        return Core::$base_url;
    }
    
    /**
     * start framework
     * @param $this
     */
    public static function vnwork($this) {
        /*
         * Call func before call main funcion
         */
        Core::set_base_url();
        //method_exists
        //Core::loader();
        $ctl = new Controller();
        $ctl->init();
        $ctl->main();
        
        exit;
    }
}