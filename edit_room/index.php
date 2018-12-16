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
if( !userOwnsroom($db, $user_id, $room_id) ){
    header("Location: ".BASE_URL."my_rooms");
    die();
}

// Extraer la información de la sala
$sql_room = "SELECT * FROM rooms WHERE id = $room_id LIMIT 1";
$result_room = mysqli_query($db, $sql_room);
$room = mysqli_fetch_assoc($result_room);

if( isset($_POST['edit_room']) ){
    $roomname = trim($_POST['roomname']) ?? null;
    $description = trim($_POST['roomdesc']) ?? null;
    $category = trim($_POST['category']) ?? null;

    // Array de errores
    $errors = [];

    // Validaciones
    // roomname:
    if ( empty($roomname) ){
        $errors['roomname']['empty'] = "Debes introducir un nombre para la sala.";
        $username = null;
    }

    if ( strlen($roomname) < 8 ) {
        $errors['roomname']['length'] = "El nombre de la sala debe tener al menos 8 caracteres.";
        $username = null;
    }

    //category:

    if ( empty($category) ){
        $errors['category']['empty'] = "Debes introducir una categoria para la sala.";
        $username = null;
    }

    if ( strlen($category) < 3 ) {
        $errors['category']['length'] = "La categoria debe tener al menos 3 caracteres.";
        $username = null;
    }

    if( empty($errors) ){
        $sql = "UPDATE rooms SET name = '$roomname', description = '$description', category = '$category' WHERE id = $room_id";
        $actualizar = mysqli_query($db, $sql);

        if( $actualizar ){
            $id = mysqli_insert_id($db);
            // Redirigir a la página de Mis salas
            header("Location: ".BASE_URL.'room/?id='.$room_id);
            die();
        }

        echo "Error: ".mysqli_error($db);
        die();   
    }
}

require_once 'editar_sala.view.php';