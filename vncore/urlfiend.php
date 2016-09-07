<?php
class URLFriend extends VNModel {
    protected $table = "url_friendly";
    
    public function get_action($url) {
        $sql = "SELECT controller, action FROM " . $this->table . " WHERE url_friendly.url_friendly = :url";
        $result = $this->query($sql, array("url" => $url));
        
        $return = false;
        
        if(count($result) > 0) {
            $return["controller"] = $result[0]['controller'];
            $return["action"] = $result[0]['action'];
        }
        
        return $return;
    }
    
    /**
    * check url friendly
    * 
    * @return
    */
    public function checkurl() {
        
        $root_url = null;
        if($_SERVER["SERVER_PORT"] == 80) {
            $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        } else {
            $root_url = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] .':'.$_SERVER["SERVER_PORT"] . $_SERVER['REQUEST_URI'];
        }
        
        $request_url = explode(Core::base_url(), $root_url);
        $request_url = isset($request_url[1])? $request_url[1]:NULL;
        $return = NULL;
        if(empty($request_url)) {
            return FALSE;
        } else {
            $request_url = explode("?", $request_url);
            $request_url = $request_url[0];
            $return = $this->get_action($request_url);
            if(count($return) > 0) {
                return $return;
            } else {
                return FALSE;
            }
        }
    }
}
