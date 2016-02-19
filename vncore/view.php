<?php

class View
{
    /**
     * @var array Array of HTTP headers
     */
    private static $headers = array();
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
            require "app/view/default/$path.php";
        } else {
            require "app/view/$custom/$path.php";
        }
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
    
    public function Json($data, $option, $depth) {
        return json_encode($data, $option, $depth);
    }
    
    /**
     * Add jquery
     */
    public static function addJquery() {
        
        $script_jquery = '<script type="text/javascript" src="'.Core::$base_url.VENDOR_FOLDER."jquery/jquery.min.js".'"></script>';
        return $script_jquery;
        
    }
}