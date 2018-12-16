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

if(  isset($_GET['room_id']) &&isset($_GET['thread_id']) && isset($_GET['message_id']) ){
    $message_id = $_GET['message_id'];
    $thread_id = $_GET['thread_id'];
    $room_id = $_GET['room_id'];

    // Comprobar que el usuario es propietario de la threada, el message existe y pertenece a la threada
    if( !userOwnsThread($db, $user_id, $thread_id) ){
        header("Location: ".BASE_URL."thread/?room_id=".$room_id."&id=".$thread_id);
        die();
    }

    if( !messageBelongsToThread ($db, $message_id, $thread_id) ){
        header("Location: ".BASE_URL."thread/?room_id=".$room_id."&id=".$thread_id);
        die();
    }

    // Borrar el message id
    $sql = "DELETE FROM messages WHERE id = $message_id";

    $result =  mysqli_query($db, $sql);

    if($result){
        header("Location: ".BASE_URL."thread/?room_id=".$room_id."&id=".$thread_id);
    }else{
        die("Error");
    }
}else{
    header("Location: ".BASE_URL);
}