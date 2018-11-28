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
        $categoria = trim($_POST['cathegory']) ?? null;

        // Array de errores
        $errors = [];

        // Validaciones
        // username:
        if ( empty($roomname) ){
            $errors['roomname']['empty'] = "Debes introducir un nombre para la sala.";
            $username = null;
        }

        if ( strlen($roomname) < 10 ) {
            $errors['roomname']['length'] = "El nombre de la sala debe tener al menos 10 caracteres.";
            $username = null;
        }

        if ( empty($categoria) ){
            $errors['cathegory']['empty'] = "Debes introducir un nombre para la sala.";
            $username = null;
        }

        if ( strlen($categoria) < 8 ) {
            $errors['cathegory']['length'] = "La categoria de la sala debe tener al menos 8 caracteres.";
            $username = null;
        }
    
        if( empty($errors) ){
            // Insertar usuario en la base de datos
            $user_id = $_SESSION['usuario']['id'];
            $sql = "INSERT INTO rooms(user_id, name, description, category) VALUES( $user_id, '$roomname', '$description', '$categoria')";

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
    require_once 'create_room.view.php';
