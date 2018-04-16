
<?php

session_start();
if (isset($_SESSION['logged']) === FALSE || isset($_SESSION['loggedAdmin']) === FALSE) {   
  header("Location: login.php");
}


$usuario1 = $_SESSION['usuario'];

$contrasena = $_SESSION['contrasena'];
                 


include("conexion.php");

$test=$_GET["test"];
$testasignad=$_GET["testasignad"];
$user=$_GET["user"];





$consultaTest="select * from preguntas where cod_test_base=$test";


$resul_consulta_Test=mysqli_query($conexion,$consultaTest);



?>

<style type="text/css">
  
body
{
  font-family: Arial, Sans-serif;
}
.error
{
color:red;
font-family:verdana, Helvetica;
}

</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TEST</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Test</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mi tablero">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Mi tablero</span>
          </a>
        </li>
       
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        
       
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Mi tablero</li>
      </ol>
      
   
        
      <!-- Example DataTables Card-->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> TEST</div>
        <div class="card-body">




  

          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Pregunta</th>
                  <th>Opciones de respuesta</th>
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Pregunta</th>
                  <th>Opciones de respuesta</th>
                  
                </tr>
              </tfoot>
              <tbody>
                <?php  

                $cont=0;
               while($result_consulta_test = mysqli_fetch_array($resul_consulta_Test,MYSQLI_ASSOC)){

                          $descripcion_pregunta=$result_consulta_test['descipcion_pregunta'];
                          $cod_pregunta=$result_consulta_test['cod_pregunta'];
                           

           ?>
                <tr>

                  <td><?php echo $descripcion_pregunta; ?></td>
                 



              <?php  

              $ConsulOpcionRes="select * from opciones_respuesta where cod_pregunta='$cod_pregunta'";
              $resul_OpcionRes=mysqli_query($conexion, $ConsulOpcionRes);



              ?>

                  <td>
                  <?php 
                  echo "<ul>";

                 echo"<p class='container'>";
                  echo "</p>";

                  while($result_consulta_OpcionRes = mysqli_fetch_array( $resul_OpcionRes,MYSQLI_ASSOC)){

                          $descipcion_opcion_respuesta=$result_consulta_OpcionRes['descripcion_opcion_respuesta'];
                          $cod_estilo=$result_consulta_OpcionRes['cod_estilo'];
                          $cod_op_res=$result_consulta_OpcionRes['cod_opcion_respuesta'];

                        //  echo "<li>".$descipcion_opcion_respuesta."</li>";

                          $consulRespuesta="select cod_opcion_respuesta from respuesta_test where username=$user and cod_test_asignado=$testasignad and cod_pregunta='$cod_pregunta'";
                          echo $consulRespuesta;

                          $resul_consulRespuesta=mysqli_query($conexion, $consulRespuesta);

                           $result_consulRespuesta = mysqli_fetch_array( $resul_consulRespuesta,MYSQLI_ASSOC);
                           $cod_op_res_eva=$result_consulRespuesta['cod_opcion_respuesta'];

                          if ($cod_op_res_eva==$cod_op_res) {

                              echo "<input type='hidden' value='$cod_pregunta' name='pre$cont' />";
                              echo " <div class='radio'> <label><input type='radio' class='required' minlength='1' name='optradio$cont' value='$cod_op_res' checked > $descipcion_opcion_respuesta</label> </div>";
 
                           } else{

                              echo "<input type='hidden' value='$cod_pregunta' name='pre$cont' />";
                              echo " <div class='radio'> <label><input type='radio' class='required' minlength='1' name='optradio$cont' value='$cod_op_res' disabled> $descipcion_opcion_respuesta</label> </div>";

                           }
                          
                         

                        }
                        $cont=$cont+1;

                       

                        echo "</ul>"


                  ?>


                  </td>

                  
                </tr>

                <?php  
                 }
                ?>
                
              </tbody>
            </table>
          </div>

         


       

        </div>
        <div class="card-footer small text-muted">CORPORACIÓN UNIRSITARIA DEL CARIBE - CECAR</div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © CECAR 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">¿Realmente deseas salir?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="salir.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/localization/messages_es.js"></script>



    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.min.js"></script>
    
  </div>
</body>

<script type="text/javascript">

$(function()
  {
    $('#formulario').validate(
      {
        rules:
        {
          Color:{ required:true }
        },
        messages:
        {
          Color:
          {
            required:"Please select a Color<br/>"
          }
        },
        errorPlacement: function(error, element) 
        {
            if ( element.is(":radio") ) 
            {
                error.appendTo( element.parents('.radio') );
            }
            else 
            { // This is the default behavior 
                error.insertAfter( element );
            }
         }
      });
    
  });

</script>

</html>
