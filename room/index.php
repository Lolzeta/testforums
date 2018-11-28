<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

if( !isset($_GET['id']) ){
    header("Location: ".BASE_URL);
}

$room_id = $_GET['id']; // Validar esto

if( isset($_POST['saveitem']) ){
    $item = trim($_POST['item']) ?? null;

    // Validaciones
    // username:
    if ( empty($item) ){
        $errors['item']['empty'] = "Debes introducir un nombre.";
        $username = null;
    }

    if( empty($errors) ){
        // Guardar item en la base de datos
        
        // Insertar usuario en la base de datos
        $sql = "INSERT INTO items(room_id, description) VALUES($room_id, '$item')";

        $guardar = mysqli_query($db, $sql);

        if( $guardar ){
            header("Location: ".BASE_URL.'room/?id='.$room_id);
            die();
        }

        echo "Error";
        die();   
    }
}else{
    // Extraer los items de la sala
    $sql_items = "SELECT * FROM items WHERE room_id = $room_id;";
    $result_items = mysqli_query($db, $sql_items);

    $sql_room = "SELECT * FROM rooms WHERE id = $room_id LIMIT 1";
    $result_room = mysqli_query($db, $sql_room);
    $room = mysqli_fetch_assoc($result_room);
}

require_once 'room.view.php';