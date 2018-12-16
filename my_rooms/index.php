<?php

require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

// Comprobar que la sesión está creada
if ( empty($_SESSION) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$user_id = $_SESSION['usuario']['id'];

$sql_rooms = "SELECT * FROM rooms WHERE user_id = $user_id";
$result_rooms = mysqli_query($db, $sql_rooms);

require_once 'my_rooms.view.php';