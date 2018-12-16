<?php
require_once '../setup.php';
require_once '../database/conexion.php';
require_once '../database/helpers.php';

if( !isset($_GET['id']) ){
    header("Location: ".BASE_URL);
}

$room_id = $_GET['id'];

if( isset($_POST['savethread']) ){
    header("Location: ".BASE_URL.'create_thread/?room_id='.$room_id);
}
    $sql_threads = "SELECT * FROM threads WHERE room_id = $room_id;";
    $result_threads = mysqli_query($db, $sql_threads);

    $sql_room = "SELECT * FROM rooms WHERE id = $room_id LIMIT 1";
    $result_room = mysqli_query($db, $sql_room);
    $room = mysqli_fetch_assoc($result_room);


require_once 'room.view.php';