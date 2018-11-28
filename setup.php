<?php

define('BASE_URL', $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."/".'testforums/');
define('BASE_PATH', __DIR__);

// Conexión a la BD
define('DB_HOST', "localhost");
define('DB_USER', "root");
define('DB_PASS', "");
<<<<<<< HEAD
define('DB_NAME', "testforumsdb");

// Iniciar Sesión
session_start();

?>
=======
define('DB_NAME', "testforums");

// Iniciar Sesión
session_start();
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5
