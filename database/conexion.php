<?php
$db = mysqli_connect("localhost", "root", "", "testforumsdb");

//  if(mysqli_connect_errno()){
//      die("La hemos cagado conectando a la BD");
//  }else{
//      die("To cremis.");
//  }

mysqli_query($db, "SET NAMES 'utf8'");
?>