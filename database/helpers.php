<?php

/**
 * Función que guarda información sobre el resultado
 * de los logins en la aplicación.
 */
function guardarLogin($db, $username, $status){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
        $ip=$_SERVER['REMOTE_ADDR'];
    }

    $browser = $_SERVER['HTTP_USER_AGENT'];

    $sql = "INSERT INTO logins VALUES(NULL, '$username', '$ip', '$browser', '$status', NOW())";

    $guardar_login = mysqli_query($db, $sql);
}

/**
 * Detect if a user owns a room.
 * 
 * @param $db Database connection.
 * @param $user_id User id.
 * @param $room_id room id.
 */
function userOwnsroom($db, $user_id, $room_id) {
    $sql = "SELECT * FROM rooms WHERE id = $room_id AND user_id = $user_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    if( mysqli_num_rows($result) == 0 ){
        return false;
    }
    return true;
}

function userOwnsThread($db, $user_id, $thread_id){
    $sql = "SELECT * FROM threads WHERE id = $thread_id AND user_id = $user_id LIMIT 1";
    $result = mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==0){
        return false;
    }
    return true;
}

/**
 * Detect if a thread belongs to a room.
 * 
 * @param $db Database connection.
 * @param $thread_id thread id.
 * @param $room_id room id.
 */
function threadBelongsToroom($db, $thread_id, $room_id) {
    $sql = "SELECT * FROM threads WHERE id = $thread_id AND room_id = $room_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    if( mysqli_num_rows($result) == 0 ){
        return false;
    }
    return true;
}

function messageBelongsToThread($db, $message_id, $thread_id) {
    $sql = "SELECT * FROM messages WHERE id = $message_id AND thread_id = $thread_id LIMIT 1";
    $result = mysqli_query($db, $sql);
    if( mysqli_num_rows($result) == 0 ){
        return false;
    }
    return true;
}