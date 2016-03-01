<?php
require_once(VENDOR_FOLDER . "phpfastcache/phpfastcache/phpfastcache.php");

phpFastCache::setup("storage", "files");
phpFastCache::setup("path", VN_TMP_DIR."cache");

class Cache extends phpFastCache{
    protected $logname = 'Cache_';
    
    /**
     * set cache data
     * @param string $key
     * @param string $string
     * @return boolean
     */
    public static function set($key, $string) {
       try {
           __c()->set($key, $string, VN_TIME_CACHE);
           return true;
       } catch (Exception $e) {
           VNLog::debug_var($this->logname, $e->getMessage());
           return false;
       }
       
    }
   
   /**
    * get cache data
    * @param string $key
    * @return string|boolean
    */
   public static function get($key) {
       try {
           $data = __c()->get($key);
           return $data;
       } catch (Exception $e) {
           VNLog::debug_var($this->logname, $e->getMessage());
           return false;
       }
   }
   
   /**
    * genaral key in cache
    * @param string $string
    * @param array $array
    * @return string
    */
   public static function genaral_key($string, $array = array()) {
       if(empty($string)) return VN_CACHE_DEFAULT;
       
       $genaral_text = sha1($string);
       
       if(!empty($array)) {
           $arr_string = implode("", $array);
           $genaral_text .= sha1($arr_string);
       }
       
       return $genaral_text;
   }
   
   //isExisting
   public static function isExisting($key){
       return __c()->isExisting($key);
   }
   
   /**
    * set data array to cache
    * @param string $key
    * @param array $array
    */
   public static function set_array($key, $array) {
       if(!empty($array)) {
           $data_json = json_encode($array);
           Cache::set($key, $data_json);
           return true;
       }
       
       return false;
   }
   
   public static function get_array($key) {
       if(__c()->isExisting($key)) {
            $data_return = __c()->get($key);
            if(!empty($data_return))
                $data_return = json_decode($data_return);
            return $data_return;
       }
       return null;
   }
   
   public static function clear() {
       __c()->clean();
   }
   
   public static function delete($key) {
       
   }
   
}