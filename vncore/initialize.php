<?php

require_once 'config/define.php';

require 'log.php';
require_once 'config/dbconfig.php';
// Core
require_once 'core.php';
// View
require 'view.php';
// Cache
require_once 'cache.php';
// DB
require 'dbaccess.php';
// Model
require 'model.php';
// Controller
require_once 'controller.php';
// Validate
require_once 'validate.php';

// URL Friendly
require_once 'urlfiend.php';

// Array
//require 'hbcore/Array.php';
// Session
//require 'hbcore/Session.php';
// Error
//require 'hbcore/Error.php';

//Session::init();	//session_start()

header('Expires: -1');
header('Cache-Control:');
header('Pragma:');
date_default_timezone_set('Asia/Saigon');
ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(E_ERROR);