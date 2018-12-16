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
if ( !isset($_GET['room_id']) && !isset($_GET['thread_id']) ){
    header("Location: ".BASE_URL.'login');
    die();
}
$room_id = $_GET['room_id'];
$thread_id = $_GET['thread_id'];

// Comprobar que el usuario es propietario de la sala
if( !userOwnsroom($db, $user_id, $room_id) ){
    header("Location: ".BASE_URL.'room/?id='.$room_id);
    die();
}

// Extraer la información de la sala
$sql_thread = "SELECT * FROM threads WHERE id = $thread_id AND room_id = $room_id AND user_id = $user_id LIMIT 1";
$result_thread = mysqli_query($db, $sql_thread);
$thread = mysqli_fetch_assoc($result_thread);

if( isset($_POST['edit_thread']) ){
    $threadname = trim($_POST['threadname']) ?? null;
    $description = trim($_POST['threaddesc']) ?? null;

    // Array de errores
    $errors = [];

    // Validaciones
    // threadname:
    if ( empty($threadname) ){
        $errors['threadname']['empty'] = "Debes introducir un nombre para la sala.";
        $username = null;
    }

    if ( strlen($threadname) < 8 ) {
        $errors['threadname']['length'] = "El nombre de la sala debe tener al menos 8 caracteres.";
        $username = null;
    }

    if( empty($errors) ){
        $sql = "UPDATE threads SET name = '$threadname', description = '$description' WHERE id = $thread_id";
        $actualizar = mysqli_query($db, $sql);

        if( $actualizar ){
            $id = mysqli_insert_id($db);
            // Redirigir a la página de la sala
            header("Location: ".BASE_URL.'room/?id='.$room_id);
            die();
        }

        echo "Error: ".mysqli_error($db);
        die();   
    }
}

require_once 'editar_hilo.view.php';