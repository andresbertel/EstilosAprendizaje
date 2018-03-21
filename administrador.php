<?php
include("conexion.php");

$consulta="select distinct e.username,e.firstname,e.lastname,e.email from test_asignado_estudiante tae 
join estudiantes e on(e.username=tae.username)  where tae.realizado='1'";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
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
    <a class="navbar-brand" href="administrador.php">Test</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Mi tablero">
          <a class="nav-link" href="administrador.php">
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Charts</li>
      </ol>
      <!-- Area Chart Example-->
      
      <div class="row">
        <div class="col-lg-8">
          <!-- Example Bar Chart Card-->
          <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Documento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                   <th>Resultado</th>
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Documento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                  <th>Resultado</th>
                </tr>
              </tfoot>
              <tbody>

     <?php 

     $resul_estudiante=mysqli_query($conexion, $consulta);
        while($result_consulta_estudiante = mysqli_fetch_array( $resul_estudiante,MYSQLI_ASSOC)){
           $documento=$result_consulta_estudiante['username'];
             $nombres=$result_consulta_estudiante['firstname'];
                $apellidos=$result_consulta_estudiante['lastname'];
                       $email=$result_consulta_estudiante['email'];


        ?>
              
                <tr>
                  <td><?php echo $documento; ?></td>
                  <td><?php echo $nombres; ?></td>
                  <td><?php echo $apellidos; ?></td>
                  <td><?php echo $email; ?></td>
                        
                      <?php  $consulta_vark="select username,es.nombre_estilo,COUNT(*) TOTAL from respuesta_test rt join opciones_respuesta ore 
                                          on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                          join estilos es on(es.cod_estilo=ore.cod_estilo)   where cod_test_asignado='102' and username=$documento

                                          group by es.cod_estilo";

                                       $resul_vark=mysqli_query($conexion, $consulta_vark);

                                       while($result_resul_vark = mysqli_fetch_array( $resul_vark,MYSQLI_ASSOC)){
                                        $valores[]=$result_resul_vark['TOTAL'];
                                        

                                         }


                                         $consulta_honey="select username,es.nombre_estilo,COUNT(*) TOTAL from respuesta_test rt join opciones_respuesta ore on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                                            join estilos es on(es.cod_estilo=ore.cod_estilo)  where cod_test_asignado='101' and username=$documento group by es.cod_estilo";

                                       $resul_honey=mysqli_query($conexion, $consulta_honey);

                                       while($result_resul_honey = mysqli_fetch_array( $resul_honey,MYSQLI_ASSOC)){
                                        $valores_honey[]=$result_resul_honey['TOTAL'];
                                        

                                         }


                                          ?>


     <td style="text-align: center; "><input type="button" name="resultado" id="resultado" value="Ver Resultado" onclick='graficarTorta("myPieChart",<?php echo json_encode($valores); ?>); graficarTorta("myBarChart",<?php echo json_encode($valores_honey); ?>);'></td>
                 
                </tr>

                <?php  } ?>
               
              </tbody>
            </table>
          </div>
          
        </div>
        <div class="col-lg-4">
          <!-- Example Pie Chart Card-->
      <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Honey y Alonso</div>
            <div class="card-body">
              <canvas id="myBarChart" width="100" height="50"></canvas>
            </div>
            
          </div>



          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Vark</div>
            <div class="card-body">
              <canvas id="myPieChart" width="100%" height="50"></canvas>
            </div>
           
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Your Website 2017</small>
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
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/chart.js/Chart.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/sb-admin-datatables.js"></script>
    
   


    <!-- Custom scripts for this page-->
    <!--<script src="js/sb-admin-charts.js"></script>-->

    <script type="text/javascript">




 function graficarTorta(idCampo,valoresGrafica){
  var ctx = document.getElementById(idCampo);
        var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["PRAGMÁTICO", "TEÓRICO", "ACTIVO", "REFLEXIVO","NINGUNO"],
            datasets: [{
              data: valoresGrafica,
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745','#6f42c1'],
    }],
  },
});

 }     
    
    var valores=[0, 0, 0, 0,0];
    graficarTorta("myPieChart",valores);

    var valores=[0, 0, 0, 0,0];
    graficarTorta("myBarChart",valores);




    </script>
  </div>
</body>

</html>
