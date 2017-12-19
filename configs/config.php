<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('HOST_APPLICATION', 'http://localhost/mvc-mercado');

require_once(WWW_ROOT . DS . 'autoload.php');