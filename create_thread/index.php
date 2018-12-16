<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';

    if ( empty($_SESSION) ){
        header("Location: ".BASE_URL.'login');
        die();
    }

    if( isset($_POST['new_thread']) ){
        $threadname = trim($_POST['threadname']) ?? null;
        $description = trim($_POST['threaddesc']) ?? null;

        // Array de errores
        $errors = [];

        // Validaciones
        // username:
        if ( empty($threadname) ){
            $errors['threadname']['empty'] = "Debes introducir un nombre para el hilo.";
            $username = null;
        }

        if ( strlen($threadname) < 8 ) {
            $errors['threadname']['length'] = "El nombre del hilo debe tener al menos 8 caracteres.";
            $username = null;
        }
    
        if( empty($errors) ){
            // Insertar usuario en la base de datos
            $user_id = $_SESSION['usuario']['id'];
            $room_id = $_GET['room_id'];
            $sql = "INSERT INTO threads(room_id, user_id, name, description) VALUES($room_id, $user_id, '$threadname', '$description')";

            $guardar = mysqli_query($db, $sql);

            if( $guardar ){
                $id = mysqli_insert_id($db);
                header("Location: ".BASE_URL.'thread/?room_id='.$room_id.'&id='.$id);
                die();
            }

            echo "Error";
            die();   
        }
    }
    require_once 'create_thread.view.php';