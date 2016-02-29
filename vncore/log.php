<?php
class VNLog
{
    private static $_user_file_suffix = "";

    public static function err($file_suffix, $e)
    {
        $msg = $e->getMessage();
        $msg .= "\n" . $e->getTraceAsString();
        static::write_file($file_suffix, $msg);
    }

    public static function debug($msg)
    {
        $msg = print_r($msg, true);
        static::write_file("Debug", $msg);
    }

    public static function sql_err($msg)
    {
        static::write_file('SQLERROR', $msg);
    }

    public static function sql_statement($sql)
    {
        static::write_file('SQLLOG', $sql);
    }

    public static function sql_param($param)
    {
        static::write_file('SQLLOG', var_export($param, true));
    }

    public static function sql($sql, $param)
    {
        $line = $sql . "\r\n";
        if (is_null($param) == false) {
            $line .= var_export($param, true);
        }
        static::write_file('SQLLOG', $line);
    }

    public static function write_file($suffix, $str)
    {
        $filepath = static::make_filepath($suffix);
        if (($fp = @fopen($filepath, "a")) === false) {
            return;
        }

        if (!flock($fp, LOCK_EX)) {
            @fclose($fp);
            return;
        }

        if (fwrite($fp, static::make_header() . $str . "\n") === false) {
            @flock($fp, LOCK_UN);
            @fclose($fp);
            return;
        }

        if (!fflush($fp)) {
            @flock($fp, LOCK_UN);
            @fclose($fp);
            return;
        }

        if (!flock($fp, LOCK_UN)) {
            @fclose($fp);
            return;
        }

        if (!fclose($fp)) {
            return;
        }
    }

    public static function write_log($filepath, $str, $lv = 'OK')
    {
        $filepath = mb_convert_encoding($filepath, 'sjis-win', 'UTF-8');
        if (($fp = @fopen($filepath, "a")) === false) {
            return;
        }

        if (!flock($fp, LOCK_EX)) {
            @fclose($fp);
            return;
        }

        if (fwrite($fp, static::make_header_custom($lv) . $str . "\r\n") === false) {
            @flock($fp, LOCK_UN);
            @fclose($fp);
            return;
        }

        if (!fflush($fp)) {
            @flock($fp, LOCK_UN);
            @fclose($fp);
            return;
        }

        if (!flock($fp, LOCK_UN)) {
            @fclose($fp);
            return;
        }

        if (!fclose($fp)) {
            return;
        }
    }

    protected static function make_header_custom($lv)
    {
        $txt = '[Success]';
        if($lv == 'ERROR'){
            $txt = '[Warning]';
        }
        return date('Y/m/d H:i') . ' '.$txt.' ';
    }

    public static function set_user_suffix($suffix)
    {
        static::$_user_file_suffix = $suffix;
    }

    protected static function make_filepath($suffix)
    {
        if (static::$_user_file_suffix != '') {
            $suffix .= '_' . static::$_user_file_suffix;
        }

        return  VN_TMP_DIR.'log/' . date('Ymd') . '_' . $suffix . '.log';
    }

    protected static function make_header()
    {
        return date('Y/m/d H:i:s') . ' access ip -> ' . $_SERVER["REMOTE_ADDR"] . "\n";
    }

    public static function debug_var($predix, $var)
    {
        static::write_file($predix, var_export($var, true));
    }

}

function var_log($obj)
{
    VNLog::debug($obj);
}
