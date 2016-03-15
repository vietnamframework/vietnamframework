<?php
class Validate {
    /**
     * @todo: check text has only string and number
     * @param text $text
     */
    public static function string_number($text) {
        if (!preg_match("/^[0-9a-zA-Z]*$/",$text)) {
            return false;
        }
        return $text;
    }
    
    /**
     * @todo: check text for action name
     * @param text $text
     */
    public static function action_name_check($text) {
        if (!preg_match("/^[0-9a-zA-Z\_]*$/",$text)) {
            return false;
        }
        return $text;
    }
    
    /**
     * @todo: check text has only string [a-zA-Z]
     * @param text $text
     */
    public static function text_only($text) {
        if (!preg_match("/^[a-zA-Z]*$/",$text)) {
            return false;
        }
        return $text;
    }
    
    /**
     * @todo: check text has only string [0-9]
     * @param text $text
     */
    public static function number_only($text) {
        if (!preg_match("/^[0-9]*$/",$text)) {
            return false;
        }
        return $text;
    }
    
    public static function text_genaral($text) {
        if (!preg_match("/^[0-9\s\.\_\w]*$/",$text)) {
            return false;
        }
        return $text;
    }
    
    /**
     * remove empty data
     * @param array $param
     */
    public static function remove_empty($param) {
        if(empty($param)) return null;
        $data = array();
        foreach ($param as $key => $value) {
            if(!empty($value)) {
                $data[$key] = $value;
            }
        }
        return $data;
    }
}