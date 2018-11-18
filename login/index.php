<?php
    require_once '../setup.php';
    require_once '../database/conexion.php';

if(isset($_SESSION['userdata'])){
    header("Location: ".APP_URL);
}

if( isset($_POST['login'])){
    // Formulario ha sido enviado
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validaciones

    if(empty($username)){
        $errors['username']['empty'] = "El usuario no puede ser un valor vacio.";
        $username = null;
    }

    if(empty($password)){
        $errors['password']['empty'] = "La contraseña no puede ser un valor vacio.";
        $password = null;
    }

    if(empty($errors)){
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";

        $login = mysqli_query($db, $sql);

        if($login && mysqli_num_rows($login) == 1){
            $usuario = mysqli_fetch_assoc($login);
        
        
        if(password_verify($password, $usuario['password'])){
            $_SESSION['userdata'] = $usuario;
            header("Location: ".APP_URL);
        } else{
            $errors['login']['password'] = "La contraseña no es correcta";
        }
    } else{
        $errors['login']['username'] = "El usuario no es correcto";
        }
    }   
}

require 'login.view.php';

?>