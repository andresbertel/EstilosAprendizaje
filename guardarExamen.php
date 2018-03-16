<?php

session_start();
if (isset($_SESSION['logged']) === FALSE) {
  header("Location: login.php");
}


$usuario1 = $_SESSION['usuario'];

$contrasena = $_SESSION['contrasena'];

$cont=0;

include("conexion.php");

$err=0;

while(isset($_POST["pre".$cont])){

//echo "Test Base: ".$_POST["testbase"]. " Usuario: ".$usuario1." Pregunta: ".$_POST["pre".$cont]." Respuesta: ".$_POST["optradio".$cont]."</br>";

$consultalogi="insert into respuesta_test values(".$_POST['testasig'].",".$usuario1.",'".$_POST['pre'.$cont]."',".$_POST['optradio'.$cont].")";
//echo "</br>";
   //echo $consultalogi;
       $sql=mysqli_query($conexion,$consultalogi);



  if($sql==TREU){
       //  echo "New record created successfully";
  }else{
        echo "Error: " . $sql . "<br>" ;
        $err=$err+1;
  }

$cont=$cont+1;

}

if($err==0){
   $consultaActualiEstado="update test_asignado_estudiante set realizado='1' where username='$usuario1' and cod_test_asignado='".$_POST['testasig']."'";
     // echo "</br>";
       //  echo $consultalogi;
           $sql2=mysqli_query($conexion,$consultaActualiEstado);


          // echo "</br>";
           //echo "Sql2: ".$sql2;

  

  if($sql2===TRUE){
     header("Location: index.php");
  }else{
      echo "Error: ";
   
  }




}



?>

