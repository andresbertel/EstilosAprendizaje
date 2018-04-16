
<?php


                 


include("conexion.php");

$test=$_POST["test"];
$testasignad=$_POST["testasignad"];
$user=$_POST["user"];

/*$test=1;
$testasignad=101;
$user=1102;*/





$consultaTest="select * from preguntas where cod_test_base=$test";


$resul_consulta_Test=mysqli_query($conexion,$consultaTest);



?>




          <div class="table-responsive">
            <table class="table table-bordered" id="dataTablere" width="100%" cellspacing="0">
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
                         

                          $resul_consulRespuesta=mysqli_query($conexion, $consulRespuesta);

                           $result_consulRespuesta = mysqli_fetch_array( $resul_consulRespuesta,MYSQLI_ASSOC);
                           $cod_op_res_eva=$result_consulRespuesta['cod_opcion_respuesta'];

                          if ($cod_op_res_eva==$cod_op_res) {

                              echo "<input type='hidden' value='$cod_pregunta' name='pre$cont' />";
                              echo " <div class='radio'> <label><input type='radio'  minlength='1' name='optradio$cont' value='$cod_op_res' checked > $descipcion_opcion_respuesta</label> </div>";
 
                           } else{

                              echo "<input type='hidden' value='$cod_pregunta' name='pre$cont' />";
                              echo " <div class='radio'> <label><input type='radio'  minlength='1' name='optradio$cont' value='$cod_op_res' disabled> $descipcion_opcion_respuesta</label> </div>";

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

          
         

  

</html>
