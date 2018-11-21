<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';

    if ( empty($_SESSION) ){
        header("Location: ".BASE_URL.'login');
        die();
    }

    if( isset($_POST['new_room']) ){
        $roomname = trim($_POST['roomname']) ?? null;
        $description = trim($_POST['roomdesc']) ?? null;

        // Array de errores
        $errors = [];

        // Validaciones
        if ( empty($roomname) ){
            $errors['roomname']['empty'] = "Debes introducir un nombre para la sala.";
            $roomname = null;
        }

        if ( strlen($roomname) < 4 ) {
            $errors['roomname']['length'] = "El nombre de la sala debe tener al menos 4 caracteres.";
            $roomname = null;
        }
    
        if( empty($errors) ){
            // Insertar usuario en la base de datos
            $user_id = $_SESSION['usuario']['id'];
            $sql = "INSERT INTO rooms VALUES(NULL, $user_id, '$roomname', '$description', NOW(), NOW())";

            $guardar = mysqli_query($db, $sql);

            if( $guardar ){
                $id = mysqli_insert_id($db);
                // Redirigir a la página de Mis salas
                header("Location: ".BASE_URL.'room/?id='.$id);
                die();
            }

            echo "Error";
            die();   
        }
    }
    require_once 'crear_sala.view.php';