<?php

require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

// Comprobar que hay sesión
if ( empty($_SESSION) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$user_id = $_SESSION['usuario']['id'];

// Comprobamos que recibimos el id por GET
if ( !isset($_GET['id']) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$room_id = $_GET['id'];

// Comprobar que el usuario es propietario de la sala
if( !userOwnsRoom($db, $user_id, $room_id) ){
    header("Location: ".BASE_URL."my_rooms");
    die();
}

// En caso afirmativo borrar la sala
$sql = "DELETE FROM rooms WHERE id = $room_id AND user_id = $user_id LIMIT 1";
$result = mysqli_query($db, $sql);

if( $result ) {
    header("Location: ".BASE_URL."my_rooms");
    die();
}else{
    echo "Error borrando la sala";
    die();
}