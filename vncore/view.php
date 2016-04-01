<?php

class View
{
    /**
     * @var array Array of HTTP headers
     */
    private static $headers = array();
    public static $templateUrl ='';
    
/**
     * return absolute path to selected template directory
     * @param  string  $path  path to file from views folder
     * @param  array   $data  array of data
     * @param  string  $custom path to template folder
     */
    public static function renderTemplateFronend($path, $data = false, $custom = false)
    {
        if (!headers_sent()) {
            foreach (self::$headers as $header) {
                header($header, true);
            }
        }
        self::set_TemplateURL();
        if ($custom === false) {
            $template = View::getTemplate();
            //require "app/view/".$template."/before.html";
            require "app/view/".$template."/$path.html";
            //require "app/view/".$template."/after.html";
        } else {
            //require "app/view/$custom/before.html";
            require "app/view/$custom/$path.html";
            //require "app/view/$custom/after.html";
        }
    }
    
    /**
     * return absolute path to selected template directory
     * @param  string  $path  path to file from views folder
     * @param  array   $data  array of data
     * @param  string  $custom path to template folder
     */
    public static function renderTemplate($path, $data = false, $custom = false)
    {
        if (!headers_sent()) {
            foreach (self::$headers as $header) {
                header($header, true);
            }
        }
        if ($custom === false) {
            $template = View::getTemplate();
            require "app/view/".$template."/before.html";
            require "app/view/".$template."/$path.html";
            require "app/view/".$template."/after.html";
        } else {
            require "app/view/$custom/before.html";
            require "app/view/$custom/$path.html";
            require "app/view/$custom/after.html";
        }
    }
    
    //public static
    /**
     * set Template
     * @param string $template
     * @return boolean
     */
    public static function setTemplate($template) {
        Session::set('template', $template);
        return true;
    }
    
    /**
     * getTemplate
     * @return Ambigous <NULL, unknown>
     */
    public static function getTemplate() {
        $template = Session::get('template');
        return $template;
    }
    /**
     * add HTTP header to headers array
     * @param  string  $header HTTP header text
     */
    public function addHeader($header)
    {
        self::$headers[] = $header;
    }
    /**
     * Add an array with headers to the view.
     * @param array $headers
     */
    public function addHeaders($headers = array())
    {
        foreach ($headers as $header) {
            $this->addHeader($header);
        }
    }
    
    public static function Json($data) {
        echo json_encode($data);
    }
    
    /**
     * Add jquery
     */
    public static function addJquery() {
        
        $script_jquery = '<script type="text/javascript" src="'.Core::$base_url.VENDOR_FOLDER."components/jquery/jquery.min.js".'"></script>';
        return $script_jquery;
        
    }
    public static function getPathView() {
        $hbaction = explode('/', $_REQUEST['hbaction']);
        $template = View::getTemplate();
        $count_path = count($hbaction);
        
        $pre_path = '';
        if($count_path > 1) {
            for ($i = 1; $i < $count_path; $i++) {
                $pre_path .= '../';
            }
        }        
        echo $pre_path."app/view/$template/";
    }
    public static function getTemplateURL() {
    	echo View::$templateUrl;
    }
    public static function set_TemplateURL() {
        $hbaction = explode('/', $_REQUEST['hbaction']);
        $template = View::getTemplate();
        $count_path = count($hbaction);        
        $pre_path = '';
        if($count_path > 1) {
            for ($i = 1; $i < $count_path; $i++) {
                $pre_path .= '../';
            }
        }
        View::$templateUrl= $pre_path."app/view/$template/";
    }
}