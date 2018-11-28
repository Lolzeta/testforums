<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

if( !isset($_GET['id']) ){
    header("Location: ".BASE_URL);
}

$room_id = $_GET['id']; // Validar esto

require_once 'room.view.php';