<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	
	$id = $_POST['id'];
	
	$name=$_POST['name'];
	$age=$_POST['age'];
	$email=$_POST['email'];	
	

	if(empty($name) || empty($age) || empty($email)) {
			
		if(empty($name)) {
			echo "<font color='red'>El nombre está en blanco</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>La edad está en blanco</font><br/>";
		}
		
		if(empty($email)) {
			echo "<font color='red'>Email está en blanco.</font><br/>";
		}		
	} else {	

		$sql = "UPDATE usuarios SET nombre=:name, edad=:age, email=:email WHERE id=:id";
		$query = $dbConn->prepare($sql);
				
		$query->bindparam(':id', $id);
		$query->bindparam(':name', $name);
		$query->bindparam(':age', $age);
		$query->bindparam(':email', $email);
		$query->execute();

		header("Location: index.php");
	}
}
?>
<?php

$id = $_GET['id'];


$sql = "SELECT * FROM usuarios WHERE id=:id";
$query = $dbConn->prepare($sql);
$query->execute(array(':id' => $id));

while($row = $query->fetch(PDO::FETCH_ASSOC))
{
	$name = $row['nombre'];
	$age = $row['edad'];
	$email = $row['email'];
}
?>
<html>
<head>	
	<title>Edición de Datos</title>
</head>

<body>
	<a href="index.php">Editar Clientes</a>
	<br/><br/>
	
	<form name="form1" method="post" action="edit.php">
		<table border="0">
			<tr> 
				<td>Nombre</td>
				<td><input type="text" name="name" value="<?php echo $name;?>"></td>
			</tr>
			<tr> 
				<td>Edad</td>
				<td><input type="text" name="age" value="<?php echo $age;?>"></td>
			</tr>
			<tr> 
				<td>Email</td>
				<td><input type="text" name="email" value="<?php echo $email;?>"></td>
			</tr>
			<tr>
				<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" name="update" value="Update"></td>
			</tr>
		</table>
	</form>
</body>
</html>
