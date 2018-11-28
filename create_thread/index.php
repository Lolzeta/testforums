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

        if ( strlen($threadname) < 10 ) {
            $errors['threadname']['length'] = "El nombre de el hilo debe tener al menos 10 caracteres.";
            $username = null;
        }
    
        if( empty($errors) ){
            // Insertar usuario en la base de datos
            $user_id = $_SESSION['usuario']['id'];
            $room_id = $_GET['room_id'];
            $sql = "INSERT INTO threads(user_id, room_id, name, description) VALUES( $user_id, $room_id, '$threadname', '$description')";

            $guardar = mysqli_query($db, $sql);

            if( $guardar ){
                $id = mysqli_insert_id($db);
                // Redirigir a la página de Mis hilos
                header("Location: ".BASE_URL.'thread/?id='.$id);
                die();
            }

            echo "Error";
            die();   
        }
    }
    require_once 'create_thread.view.php';
