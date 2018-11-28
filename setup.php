<?php
$url = $_SERVER['REQUEST_SCHEME']."://";
// $port = ":".$_SERVER['SERVER_PORT'];
$serverName = $_SERVER['SERVER_NAME']."/";
$urlParts = explode("/",$_SERVER['REQUEST_URI']);
$request = $urlParts[1]."/";
/** URL principal de la aplicación */
define('APP_URL', $url.$serverName.$request);

define('BASE_URL', $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".'testforums/');
define('BASE_PATH', __DIR__);

// Conexión a la BD
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
define('DB_NAME', "testforumsdb");

// Iniciar Sesión
session_start();

?>