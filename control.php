<head>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
</head>
<?php

session_start();
if (isset($_SESSION['logged']) === FALSE || isset($_SESSION['loggedAdmin']) === FALSE) {   
  header("Location: login.php");
}


$usuario1 = $_SESSION['usuario'];

$contrasena = $_SESSION['contrasena'];


include("conexion.php");
 
//conexiones, conexiones everywhere
ini_set('display_errors', 1);
error_reporting(E_ALL);



    if(isset($_POST['submit']))
    {
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
        // echo 'Cargando nombre del archivo: '.$fname.' <br>';
         $chk_ext = explode(".",$fname);
 
         if(strtolower(end($chk_ext)) == "csv")
         {
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");

             $hoy = date("Y-m-d H:i:s"); ?>


<div class="table-responsive" style="width: 80%; margin-left: auto; margin-right: auto;">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Documento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                   <th>Grupo</th>
                   <th>Periodo</th>
                   
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Documento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                  <th>Grupo</th>
                   <th>Periodo</th>
                   
                </tr>
              </tfoot>
              <tbody>

               <?php


            
             while (($data = fgetcsv($handle, 1000, ";")) !== FALSE)
             {

               //Insertamos los datos con los valores...
                $sql = "insert into estudiantes (username,firstname,lastname,email,grupo,periodo) values('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]')";

                $sql2 ="insert into test_asignado_estudiante (username, cod_test_asignado,fecha_asignado,realizado) values('$data[0]','101','$hoy',0)";

           

                 $sql3 ="insert into test_asignado_estudiante (username, cod_test_asignado,fecha_asignado,realizado) values('$data[0]','102','$hoy',0)";

           
                



               if (mysqli_query($conexion,$sql)>0){

                      mysqli_query($conexion,$sql2);
                      mysqli_query($conexion,$sql3);

                      
               }else{

                      mysqli_query($conexion,$sql2);
                      mysqli_query($conexion,$sql3);

                

               }

               ?>
            <tr>
                <td style="text-align: center; "><?php echo $data[0] ?> </td>
                <td style="text-align: center; "><?php echo $data[1] ?> </td>
                <td style="text-align: center; "><?php echo $data[2] ?> </td>
                <td style="text-align: center; "><?php echo $data[3] ?> </td>
                <td style="text-align: center; "><?php echo $data[4] ?> </td>
                <td style="text-align: center; "><?php echo $data[5] ?> </td>
            </tr>
               <?php
             }



             //cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);

           

             
             echo "<h1 style='text-align:center; margin-bottom:20px;margin-top:20px;'>Importación exitosa!</h1>";

             ?>

             </tbody>
            </table>

           <center> <input type="button"  value="Regresar" class="btn-primary" onclick="location.href='administrador.php'" ></center>

             



             <?php


             //;
         }
         else
         {
            //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
//ver si esta separado por " , "
           
             echo "<h1 style='text-align:center; margin-bottom:20px;margin-top:20px;'>Archivo invalido!</h1>";
             echo "<center><img src='image/corrupto.png'><center>";

             echo " <center> <input type='button'  value='Regresar' class='btn-primary' onclick=\"location.href='administrador.php'\" ></center>";
         }
    }
 
?>