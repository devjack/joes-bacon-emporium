<?php
session_start();
date_default_timezone_set ("Australia/Sydney");
ini_set('display_errors', true);

// http://gonzalo123.com/2012/10/15/how-to-rewrite-urls-with-php-5-4s-built-in-web-server/
if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
	return false;
}

if(!array_key_exists('QUERY_STRING', $_SERVER)) { $_SERVER['QUERY_STRING'] = ''; }
$route = str_replace('?'.$_SERVER['QUERY_STRING'],'', $_SERVER['REQUEST_URI']);
$route = str_replace($_SERVER['SCRIPT_NAME'], '', $route);

define('DS', DIRECTORY_SEPARATOR);
define('PAGES_DIR', 'actions/');

/**************  MYSQL ******************/
$db = new \Mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
global $db; // please don't kill me internets - this was designed to be intentionally bad code!


$pageTemplate = PAGES_DIR.DS.$route.'.php';

if( $route == '/') {
	$pageTemplate = PAGES_DIR.DS.'index'.'.php';
}

if(!is_readable($pageTemplate)) {
	$pageTemplate = PAGES_DIR.'/404.php';
	http_response_code(404);
}

ob_start();
require $pageTemplate;
$content = ob_get_clean();

require_once 'template.php';
