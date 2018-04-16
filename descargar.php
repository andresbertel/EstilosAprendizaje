<?php
session_start();
if (isset($_SESSION['logged']) === FALSE || isset($_SESSION['loggedAdmin']) === FALSE) {   
  header("Location: login.php");
}


$usuario1 = $_SESSION['usuario'];

$contrasena = $_SESSION['contrasena'];


header("Content-disposition: attachment; filename=formatoSubidaEstudiantes.csv");
header ("Content-Type: application/octet-stream");
readfile("formatoSubidaEstudiantes.csv");


?>