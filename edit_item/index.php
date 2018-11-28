<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

$item_id = $_GET['item_id'];
$room_id = $_GET['room_id'];

if( isset($_GET['room_id']) && isset($_GET['item_id']) ){

    // Comprobar que el usuario es propietario de la sala, el item existe y pertenece a la sala

    if( isset($_POST['edit_item']) ) {
        // Editar item
        $item = trim($_POST['item']) ?? null;
        
        // Validaciones
        if ( empty($item) ){
            $errors['item']['empty'] = "Debes introducir un texto para la tarea.";
            $username = null;
        }
        if( empty($errors) ){
            // Guardar item en la base de datos

            // Insertar usuario en la base de datos
            $sql = "UPDATE items SET description = '$item' WHERE id = $item_id";

            $result = mysqli_query($db, $sql);

            if( $result ){
                header("Location: ".BASE_URL.'room/?id='.$room_id);
                die();
            }

            echo "Error";
            die();   
        }
    }
        // Mostrar form con la información actual del item

        $sql = "SELECT rooms.id as 'room_id', rooms.name as 'room_name', items.description as 'item_text' FROM items INNER JOIN rooms ON items.room_id = rooms.id WHERE items.id = $item_id LIMIT 1";
        $result = mysqli_query($db, $sql);
        $item = mysqli_fetch_assoc($result);
    
}else{
    header("Location: ".BASE_URL);
}

require_once 'edit_item.view.php';