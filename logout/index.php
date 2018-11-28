<?php

require_once '../setup.php';

// Esto debe ir antes del session_destroy()
session_unset();

session_destroy();

<<<<<<< HEAD
<<<<<<< HEAD
header("Location: ".APP_URL);
?>
=======
header("Location: ".BASE_URL);
>>>>>>> 4199604424e0c45d36313a853de136d81ab28fd7
=======
header("Location: ".BASE_URL);
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5
