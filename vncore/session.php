<?php

class Session
{
	static protected $pre_token;
	public static function init()
	{
		session_start();
		$token = md5(uniqid(rand(),1));
		static::$pre_token = static::get('acw_token');
		static::set('acw_token', $token);
	}

	public static function regenerate()
	{
		session_regenerate_id(true);
	}

	public static function get_id()
	{
		return session_id();
	}

	public static function set_id($id)
	{
		return session_id($id);
	}

	public static function set($key, $val)
	{
		$_SESSION[$key] = $val;
	}

	public static function get($key)
	{
		if (isset($_SESSION[$key]) == false) {
			return null;
		}
		return $_SESSION[$key];
	}

	public static function check_token($param_token)
	{
		return ($param_token === static::get('acw_token')) ? true : false;
	}

	public static function del($key)
	{
		unset($_SESSION[$key]);
	}

	public static function destroy()
	{
		$_SESSION = array(); 
		session_destroy();
	}

	public static function write_close($restart=false)
	{
		session_write_close();
		if ($restart()) {
			session_start();
		}
	}
}
