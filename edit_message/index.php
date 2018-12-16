<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

$message_id = $_GET['message_id'];
$thread_id = $_GET['thread_id'];
$room_id = $_GET['room_id'];

if( isset($_GET['room_id']) && isset($_GET['thread_id']) && isset($_GET['message_id']) ){

    // Comprobar que el usuario es propietario de la threada, el message existe y pertenece a la threada

    if( isset($_POST['edit_message']) ) {
        // Editar message
        $message = trim($_POST['message']) ?? null;
        
        // Validaciones
        if ( empty($message) ){
            $errors['message']['empty'] = "Debes introducir un texto para cambiar el mensaje.";
            $username = null;
        }
        if( empty($errors) ){
            // Guardar message en la base de datos

            // Insertar usuario en la base de datos
            $sql = "UPDATE messages SET description = '$message' WHERE id = $message_id";

            $result = mysqli_query($db, $sql);

            if( $result ){
                header("Location: ".BASE_URL."thread/?room_id=".$room_id."&id=".$thread_id);
                die();
            }

            echo "Error";
            die();   
        }
    }
        // Mostrar form con la información actual del message

        $sql = "SELECT threads.id as 'thread_id', threads.name as 'thread_name', messages.description as 'message_text' FROM messages INNER JOIN threads ON messages.thread_id = threads.id WHERE messages.id = $message_id LIMIT 1";
        $result = mysqli_query($db, $sql);
        $message = mysqli_fetch_assoc($result);
    
}else{
    header("Location: ".BASE_URL);
}

require_once 'edit_message.view.php';