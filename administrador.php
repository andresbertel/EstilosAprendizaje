<?php
session_start();
if (isset($_SESSION['logged']) === FALSE || isset($_SESSION['loggedAdmin']) === FALSE) {   
  header("Location: login.php");
}


$usuario1 = $_SESSION['usuario'];

$contrasena = $_SESSION['contrasena'];


include("conexion.php");



$consulta="select distinct e.username,e.firstname,e.lastname,e.email,e.grupo,e.periodo from test_asignado_estudiante tae 
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
 

 <style type="text/css">
   .modal-dialog{
    max-width: 80%;
   }
 </style>



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

    <div id="archivo" style="text-align: center; background-color:#e9ecef; padding-bottom: 20px;
    margin-bottom: 20px;">
      <h1>Importando archivo CSV</h1>
      <form action='control.php' method='post' enctype="multipart/form-data">
   Importar Archivo : <input type='file' name='sel_file' size='20'>
   <input type='submit' name='submit' value='Subir Estudiantes'><span style="float: right; margin-right: 30px;"><a href="descargar.php">Descargar Formato</a></span>
  </form>
    </div>


          <!-- Example Bar Chart Card-->
          <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Documento</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>Email</th>
                   <th>Grupo</th>
                   <th>Periodo</th>
                   <th>Resultado</th>
                  
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
                       $grupo=$result_consulta_estudiante['grupo'];
                       $periodo=$result_consulta_estudiante['periodo'];


        ?>
              
                <tr>
                  <td><?php echo $documento; ?></td>
                  <td><?php echo $nombres; ?></td>
                  <td><?php echo $apellidos; ?></td>
                  <td><?php echo $email; ?></td>
                  <td><?php echo $grupo; ?></td>
                  <td><?php echo $periodo; ?></td>
                        
                      <?php  $consulta_vark="select username,es.nombre_estilo,ROUND((COUNT(*)*100 )/(select count(*) totalPreguntas from respuesta_test where username=$documento and cod_test_asignado='102'),2)TOTAL from respuesta_test rt join opciones_respuesta ore 
                                          on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                          join estilos es on(es.cod_estilo=ore.cod_estilo)   where cod_test_asignado='102' and username=$documento

                                          group by es.cod_estilo";

                                       $resul_vark=mysqli_query($conexion, $consulta_vark);

                                       while($result_resul_vark = mysqli_fetch_array( $resul_vark,MYSQLI_ASSOC)){
                                        $valores[]=$result_resul_vark['TOTAL'];
                                        

                                         }


                                         /*$consulta_honey="select username,es.nombre_estilo,ROUND((COUNT(*)*100 )/(select count(*) totalPreguntas from respuesta_test where username=$documento and cod_test_asignado='101'),2)TOTAL from respuesta_test rt join opciones_respuesta ore 
                                          on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                          join estilos es on(es.cod_estilo=ore.cod_estilo)   where cod_test_asignado='101' and username=$documento

                                          group by es.cod_estilo
                                          ";*/

                                         $consulta_honey= "select username,es.nombre_estilo,ROUND((COUNT(*)*100 )/(select count(*) totalPreguntas from respuesta_test re1 where re1.username=$documento and re1.cod_test_asignado='101'and re1.cod_opcion_respuesta in(select cod_opcion_respuesta  from opciones_respuesta WHERE cod_estilo<>'9')),2)TOTAL from respuesta_test rt join opciones_respuesta ore 
                                          on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
                                          join estilos es on(es.cod_estilo=ore.cod_estilo)   where cod_test_asignado='101' and username=$documento and ore.cod_estilo<>'9'

                                          group by es.cod_estilo order by TOTAL desc";

                                       $resul_honey=mysqli_query($conexion, $consulta_honey);

                                       while($result_resul_honey = mysqli_fetch_array( $resul_honey,MYSQLI_ASSOC)){
                                        $valores_honey[]=$result_resul_honey['TOTAL'];
                                        

                                         }


                                          ?>


     <td style="text-align: center; "><input type="button" name="resultado" id="resultado" value="Ver Resultado" onclick='graficarTortavark("myPieChart",<?php echo json_encode($valores).",\"$nombres $apellidos\",$documento,102,2" ?>); graficarTorta("myBarChart",<?php echo json_encode($valores_honey).",\"$nombres $apellidos\",$documento,101,1" ?>);'></td>
                 <?php  unset($valores);
                    unset($valores_honey) ?>
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
              <i class="fa fa-bar-chart"></i> Estadisticas Generales</div>
            <div class="card-body" id="estadist">
              <input type="button" name="estadisticas" id="estadisticas" value="Estadisticas Generales Honey y Alonso" class="btn-primary" data-toggle="modal" data-target="#modalEstaditicas">
              <input type="button" name="estadisticas" id="estadisticas" value="Estadisticas Generales Vark" class="btn-primary" data-toggle="modal" data-target="#modalEstaditicasvark">
            </div>
            
          </div>
      <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-bar-chart"></i> Honey y Alonso <span> | </span><span id="nombreAlumno"></span><span style="float: right;" id="resulExamenAlu">
                <input type="button" name="estadisticas" id="verExamenAl" value="Ver Examen" class="btn-primary" data-toggle="modal" data-target="#modalRespuestaExamenEstu" >
              </span>
            </div>
            <div class="card-body" id="grafico1">
              <canvas id="myBarChart" width="100" height="50"></canvas>
            </div>
            
          </div>



          <div class="card mb-3">
            <div class="card-header">
              <i class="fa fa-pie-chart"></i> Vark <span> | </span><span id="nombreAlumnoVark"></span><span style="float: right;" id="resulExamenAlu">
                <input type="button" name="estadisticas" id="verExamenAlVark" value="Ver Examen" class="btn-primary" data-toggle="modal" data-target="#modalRespuestaExamenEstu" >
              </span></div>
            <div class="card-body" id="grafico2">
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

 <?php

 $estadisticas_vark="select es.nombre_estilo,COUNT(*) TOTAL,(SELECT SUM(TOTAL) FROM (select COUNT(*) TOTAL
from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)
where cod_test_asignado='102'
group by es.cod_estilo) AS TODOS) AS TOTALGENERAL
from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)
where cod_test_asignado='102'
group by es.cod_estilo";





 $estadisticas_honey="select es.nombre_estilo,COUNT(*) TOTAL,(SELECT SUM(TOTAL) FROM (select COUNT(*) TOTAL
from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)
where cod_test_asignado='101'
group by es.cod_estilo) AS TODOS) AS TOTALGENERAL
from respuesta_test rt join opciones_respuesta ore 
on(rt.cod_opcion_respuesta=ore.cod_opcion_respuesta)
join estilos es on(es.cod_estilo=ore.cod_estilo)
where cod_test_asignado='101'
group by es.cod_estilo";

$resul_Esta_honey=mysqli_query($conexion, $estadisticas_honey);

                                    

 ?>


    <div class="modal fade" id="modalEstaditicas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ESTADISTICAS GENERALES HONEY Y ALONSO</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Estilo</th>
                  <th>Numero</th>
                  <th>Porcentaje</th>
                  
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Estilo</th>
                  <th>Numero</th>
                  <th>Porcentaje</th>
                  
                </tr>
              </tfoot>
                  <tbody>
                    
                      <?php  
                       while($result_Esta_honey = mysqli_fetch_array( $resul_Esta_honey,MYSQLI_ASSOC)){
                                                 $estilo_honey=$result_Esta_honey['nombre_estilo'];
                                                 $total_honey=$result_Esta_honey['TOTAL'];
                                                 $total_general_honey=$result_Esta_honey['TOTALGENERAL'];
                                                 $porcentaje_honey=($total_honey*100)/$total_general_honey;
                                               ?>

                      <tr>                         
                            <td><?php echo $estilo_honey;?></td>
                            <td><?php echo $total_honey;?></td>
                            <td><?php echo round($porcentaje_honey,2);?>%
                             <div class="progress progress-striped active">
                                          <div class="progress-bar" role="progressbar"
                                               aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                               style="width: <?php echo round($porcentaje_honey,2);?>%">
                                            <span class="sr-only">45% completado</span>
                                          </div>
                                        </div>

                            </td>
                      </tr>
                    <?php  }  ?>
                    

                  </tbody>
            </table>
           <div><span style="font-weight: bold;">Total General:  </span><span><?php echo $total_general_honey; ?></span></div>

          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>




<div class="modal fade" id="modalEstaditicasvark" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">ESTADISTICAS GENERALES VARK</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
             <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

              <thead>
                <tr>
                  <th>Estilo</th>
                  <th>Numero</th>
                  <th>Porcentaje</th>
                  
                  
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Estilo</th>
                  <th>Numero</th>
                  <th>Porcentaje</th>
                  
                </tr>
              </tfoot>
                  <tbody>
                    
                      <?php  


                      $resul_Esta_vark=mysqli_query($conexion, $estadisticas_vark);

                                       while($result_Esta_vark = mysqli_fetch_array( $resul_Esta_vark,MYSQLI_ASSOC)){
                                                $estilo_vark=$result_Esta_vark['nombre_estilo'];
                                                 $total_vark=$result_Esta_vark['TOTAL'];
                                                 $total_general_vark=$result_Esta_vark['TOTALGENERAL'];
                                                 $porcentaje_vark=($total_vark*100)/$total_general_vark;
                                        

                                               ?>

                      <tr>                         
                            <td><?php echo $estilo_vark;?></td>
                            <td><?php echo $total_vark;?></td>
                            <td><?php echo round($porcentaje_vark,2);?>%    <div class="progress progress-striped active">
                                          <div class="progress-bar" role="progressbar"
                                               aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                               style="width: <?php echo round($porcentaje_vark,2);?>%">
                                            <span class="sr-only">45% completado</span>
                                          </div>
                                        </div></td>
                      </tr>
                    <?php  }  ?>
                    

                  </tbody>
            </table>
           <div><span style="font-weight: bold;">Total General:  </span><span><?php echo $total_general_vark; ?></span></div>

          </div>
          <div class="modal-footer">
            
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="modalRespuestaExamenEstu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">TEST RESUELTO</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body" id="EspacioResultado">
              
             

          </div>
          <div class="modal-footer">
            
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




 function graficarTorta(idCampo,valoresGrafica,nombre,documento,testasignado,idtest){

  var nombreEnVark = document.getElementById("nombreAlumno");
  nombreEnVark.innerHTML=nombre;

    var NomBoton = document.getElementById("verExamenAl");
    NomBoton.setAttribute('onClick','verResulEx('+idtest+','+testasignado+','+documento+')');
   
   
  
  
  var padre=$("#"+idCampo).parents().attr("id");
  
     $("#"+idCampo).remove(); // this is my <canvas> element
 /* borrar=document.getElementById(idCampo); 
  alert(borrar);
     padre.removeChild(borrar);*/
     
     $("#"+padre).append('<canvas id='+idCampo+' width="100" height="50"></canvas>');
     
      var ctx = document.getElementById(idCampo);

       var pieOptions = {
  events: false,
  animation: {
    duration: 500,
    easing: "easeOutQuart",
    onComplete: function () {
      var ctx = this.chart.ctx;
      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
      ctx.textAlign = 'center';
      ctx.textBaseline = 'bottom';

      this.data.datasets.forEach(function (dataset) {

        for (var i = 0; i < dataset.data.length; i++) {
          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
              start_angle = model.startAngle,
              end_angle = model.endAngle,
              mid_angle = start_angle + (end_angle - start_angle)/2;

          var x = mid_radius * Math.cos(mid_angle);
          var y = mid_radius * Math.sin(mid_angle);

          ctx.fillStyle = '#fff';
          if (i == 3){ // Darker text color for lighter background
            ctx.fillStyle = '#444';
          }
          var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
          ctx.fillText(dataset.data[i]+ "%", model.x + x, model.y + y);
          // Display percent in another line, line break doesn't work for fillText
        //  ctx.fillText(percent, model.x + x, model.y + y + 15);
        }
      });               
    }
  }
};
      
      
     var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["PRAGMÁTICO", "TEÓRICO", "ACTIVO", "REFLEXIVO"],
            datasets: [{
              data: valoresGrafica,
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
  options: pieOptions
});





 }  
 
  function graficarTortavark(idCampo,valoresGrafica,nombre,documento,testasignado,idtest){
   
  var nombreEnVark = document.getElementById("nombreAlumnoVark");
  nombreEnVark.innerHTML=nombre;

  var NomBotonVark = document.getElementById("verExamenAlVark");
  NomBotonVark.setAttribute('onClick','verResulEx('+idtest+','+testasignado+','+documento+')');



  
  
  var padre=$("#"+idCampo).parents().attr("id");
  
     $("#"+idCampo).remove(); // this is my <canvas> element
 /* borrar=document.getElementById(idCampo); 
  alert(borrar);
     padre.removeChild(borrar);*/
     
     $("#"+padre).append('<canvas id='+idCampo+' width="100" height="50"></canvas>');
     
      var ctx = document.getElementById(idCampo);

      var pieOptions = {
  events: false,
  animation: {
    duration: 500,
    easing: "easeOutQuart",
    onComplete: function () {
      var ctx = this.chart.ctx;
      ctx.font = Chart.helpers.fontString(Chart.defaults.global.defaultFontFamily, 'normal', Chart.defaults.global.defaultFontFamily);
      ctx.textAlign = 'center';
      ctx.textBaseline = 'bottom';

      this.data.datasets.forEach(function (dataset) {

        for (var i = 0; i < dataset.data.length; i++) {
          var model = dataset._meta[Object.keys(dataset._meta)[0]].data[i]._model,
              total = dataset._meta[Object.keys(dataset._meta)[0]].total,
              mid_radius = model.innerRadius + (model.outerRadius - model.innerRadius)/2,
              start_angle = model.startAngle,
              end_angle = model.endAngle,
              mid_angle = start_angle + (end_angle - start_angle)/2;

          var x = mid_radius * Math.cos(mid_angle);
          var y = mid_radius * Math.sin(mid_angle);

          ctx.fillStyle = '#fff';
          if (i == 3){ // Darker text color for lighter background
            ctx.fillStyle = '#444';
          }
          var percent = String(Math.round(dataset.data[i]/total*100)) + "%";
          ctx.fillText(dataset.data[i]+ "%", model.x + x, model.y + y);
          // Display percent in another line, line break doesn't work for fillText
        //  ctx.fillText(percent, model.x + x, model.y + y + 15);
        }
      });               
    }
  }
};

      
     var myPieChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ["KINESTÉSICO", "VISUAL", "LECTO-ESCRIT", "AUDITIVO"],
            datasets: [{
              data: valoresGrafica,
              backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },

  options: pieOptions

});


      





 }
    


                 function verResulEx(vtest,vtestasignado,vuser){

                        $.post("respuestaExamenesEstu.php", {test: vtest, testasignad: vtestasignado, user: vuser}, function(htmlexterno){
                             $("#EspacioResultado").html(htmlexterno);
                             });
                           

                         }



                           

         



    </script>
  </div>
</body>

</html>
