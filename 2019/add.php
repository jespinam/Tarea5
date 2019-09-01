<html>
<head>
	<title>Agregar Datos de Usuario</title>
</head>

<body>
<?php

include_once("config.php");

if(isset($_POST['Submit'])) {	
	$name = $_POST['nombre'];
	$age = $_POST['edad'];
	$email = $_POST['email'];
		

	if(empty($name) || empty($age) || empty($email)) {
				
		if(empty($name)) {
			echo "<font color='red'>Campo en blanco.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Campo en blanco.</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Campo en blanco.</font><br/>";
		}
		

		echo "<br/><a href='javascript:self.history.back();'>Regresar</a>";
	} else {

		$sql = "INSERT INTO usuarios (nombre, edad, email) VALUES(:name, :age, :email)";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':name', $name);
		$query->bindparam(':age', $age);
		$query->bindparam(':email', $email);
		$query->execute();

		//display success message
		echo "<font color='green'>Datos Agregados Exitósamente.";
		echo "<br/><a href='index.php'>Ver Resultados</a>";
	}
}
?>
</body>
</html>
