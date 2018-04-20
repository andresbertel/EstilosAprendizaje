<?php


session_start();





require 'conexion.php';


if (isset($_REQUEST['iniciar'])) {
  $usuario = $_REQUEST['usuario'];
  $password = $_REQUEST['contrasena'];

$encriptar1 = password_hash($password, PASSWORD_BCRYPT, ["cost" => '11']);

 # $sql = $conexion->query("select cedula,password from responsable cedula='$usuario'");
   

   $consultalogi="select username from estudiantes where username='$usuario'";
   //echo $consultalogi;
  $sql=mysqli_query($conexion,$consultalogi);
  


  while ($login = mysqli_fetch_array($sql,MYSQLI_ASSOC)) {
  
    $usuarioDB = $login['username'];
    $passwordDB = $login['username'];

    //echo "Pas1 ".$encriptar."\n" ;
   // echo "Pass ".$passwordDB."\n";
  }

  $encriptar = password_hash($passwordDB, PASSWORD_BCRYPT, ["cost" => '11']);

 if ($usuario == isset($usuarioDB) && password_verify($password , $encriptar)) {
   #if ($usuario == isset($usuarioDB) && $password==isset($passwordDB)) {
    $_SESSION['logged'] = "Logged";
    $_SESSION['usuario'] = $usuarioDB;
    $_SESSION['password'] = $passwordDB;
     

      
  
    header("Location:index.php");


  }elseif($usuario=="admin" && $password=="Cecarvirtual2"){
             $_SESSION['logged'] = "Logged";
            $_SESSION['loggedAdmin'] = "loggedAdmin";

            header("Location:administrador.php");
       }



  elseif ($usuario !== isset($usuarioDB)) {
    echo "<div class='error'><span>El Nombre de Usuario que has Introducido es Incorrecto</span></div>";
  } elseif (password_verify($password, $passwordDB) === FALSE) {
    echo "<div class='error'><span>La Contraseña que has Introducido es Incorrecta</span></div>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Estilos de Aprendizaje</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

  <style type="text/css">
    
.error {

  top: 10px;
  right: 10px;
  color: #a94442;
  background-color: #f2dede;
  border-color: #ebccd1;
  border-radius: 4px;
  transition: all 1s;
}
.error span {
  display: block;
  padding: 16px 26px;
  text-align: center;
}

  </style>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form id="login-form"  method="post">
          <div class="form-group">
            <label for="lg_username">Usuario</label>
            <input class="form-control" id="lg_username" name="usuario" type="text" aria-describedby="emailHelp" placeholder="Ingrese Usuario" required="">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control"  type="password" placeholder="Password" id="lg_password" name="contrasena" placeholder="contraseña" required="">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" id="lg_remember" name="lg_remember"> Remember Password</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" name="iniciar">Acceder</i></button
          
        </form>
        
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
