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
<<<<<<< HEAD
        $categoria = trim($_POST['cathegory']) ?? null;
=======
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5

        // Array de errores
        $errors = [];

        // Validaciones
<<<<<<< HEAD
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
=======
        if ( empty($roomname) ){
            $errors['roomname']['empty'] = "Debes introducir un nombre para la sala.";
            $roomname = null;
        }

        if ( strlen($roomname) < 4 ) {
            $errors['roomname']['length'] = "El nombre de la sala debe tener al menos 4 caracteres.";
            $roomname = null;
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5
        }
    
        if( empty($errors) ){
            // Insertar usuario en la base de datos
            $user_id = $_SESSION['usuario']['id'];
<<<<<<< HEAD
            $sql = "INSERT INTO rooms(user_id, name, description, cathegory) VALUES( $user_id, '$roomname', '$description', '$categoria')";
=======
            $sql = "INSERT INTO rooms VALUES(NULL, $user_id, '$roomname', '$description', NOW(), NOW())";
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5

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
<<<<<<< HEAD
    require_once 'create_room.view.php';
=======
    require_once 'crear_sala.view.php';
>>>>>>> c3b2b200ddaac88041f3ee0ae83d5741ba2064b5
