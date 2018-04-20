<?php


	// Ejemplo de conexión a base de datos MySQL con PHP.
	//
	// Ejemplo realizado por Oscar Abad Folgueira: http://www.oscarabadfolgueira.com y https://www.dinapyme.com
	
	// Datos de la base de datos
	/*$usuario = "piescomc_cuadro";
	$password = "Cec@rvirtual1";
	$servidor = "localhost";
	$basededatos = "piescomc_cuadro";*/


	/*$usuario = "piescomc_estiloo";
	$password = "Cec@rvirtual1";
	$servidor = "localhost";
	$basededatos = "piescomc_estilosdeaprendizaje";*/

	$usuario = "root";
	$password = "";
	$servidor = "localhost";
	$basededatos = "test_estilos";
	
	// creación de la conexión a la base de datos con mysql_connect()
	$conexion = mysqli_connect( $servidor, $usuario, $password ) or die ("No se ha podido conectar al servidor de Base de datos");


	mysqli_set_charset($conexion,"utf8");
	
	// Selección del a base de datos a utilizar
	$db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Pues va a ser que no se ha podido conectar a la base de datos" );
	// establecer y realizar consulta. guardamos en variable.
	
	// Motrar el resultado de los registro de la base de datos
	// Encabezado de la tabla
	
	
?>