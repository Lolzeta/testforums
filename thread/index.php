<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

if( !isset($_GET['id']) && !isset($_GET['room_id']) ){
    header("Location: ".BASE_URL);
}

$thread_id = $_GET['id'];
$room_id = $_GET['room_id'];
$user_id = $_SESSION['usuario']['id'];

if( isset($_POST['savemessage']) ){
    $message = trim($_POST['message']) ?? null;

    // Validaciones
    // username:
    if ( empty($message) ){
        $errors['message']['empty'] = "Debes introducir un nombre.";
        $username = null;
    }

    if( empty($errors) ){
        $sql = "INSERT INTO messages(thread_id, user_id, description) VALUES($thread_id, $user_id, '$message')";

        $guardar = mysqli_query($db, $sql);

        if( $guardar ){
            header("Location: ".BASE_URL.'thread/?room_id='.$room_id.'&id='.$thread_id);
            die();
        }

        echo "Error";
        die();   
    }
}
    // Extraer los messages del hilo
    $sql_messages = "SELECT * FROM messages WHERE thread_id = $thread_id;";
    $result_messages = mysqli_query($db, $sql_messages);

    $sql_thread = "SELECT * FROM threads WHERE id = $thread_id LIMIT 1";
    $result_thread = mysqli_query($db, $sql_thread);
    $thread = mysqli_fetch_assoc($result_thread);


require_once 'thread.view.php';