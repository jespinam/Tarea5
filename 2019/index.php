<?php
include_once("config.php");
?>

<html>
<head>	
	<title>Usuarios</title>
</head>

<body>
<a href="add.html">Agregar Nueva Dato</a><br/><br/>

	<table width='80%' border=0>

	<tr bgcolor='#CCCCCC'>
		<td>Nombre</td>
		<td>Edad</td>
		<td>Email</td>
		<td>Actualizar</td>
	</tr>
	<?php 
	require_once('lib/nusoap.php');
	$wsdl = "http://localhost:8080/Tarea_DW/2019/servicio.php?wsdl";
	

	$client = new nusoap_client($wsdl, 'wsdl');
	$err = $client->getError();
	if ($err) {

	   echo '<h2>Error en la construccion</h2>' . $err;
	   // At this point, you know the call that follows will fail
	   exit();
	}	

		$result1=$client->call('obtenerdatos', array());

		echo $result1;
		print_r($result1);
	?>
	</table>
</body>
</html>
