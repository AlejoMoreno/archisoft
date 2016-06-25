<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="styles.css">
</head>

<div id="logo"> <img src="helpfile.jpeg"></div>
<div id="main">
<ul id="navigationMenu">
    <li><a class="home" href="menu.php"><span>Inicio</span></a></li>    
    <li><a class="about" href="ubicacion.php"><span>Empieza a trabajar</span></a></li>
    <li><a class="services" href="buscar.php"><span>Encuentra tus carpetas</span></a></li>    
    <li><a class="portfolio" href="reportes.php"><span>Enterate de todo</span></a></li>   
    <li><a class="contact" href="salida.php"><span>Termina de trabajar</span></a></li>
</ul>
</div>

<div id="formulario">
	<center><h1>UBICACIÓN CAJA</h1><hr></center>
	<p>Digíte la cédua que desea encontrar en la bodega:</p>
	<form action="" method="post" class="registro">
		<input name="cedula" id="cedula" type="text" placeholder="cédula a buscar"/><span class="info">Cédula</span>
		<input type="submit" id="boton" name="enviar" value="Buscar">
	</form>
</div>

<?php
include_once "conexion.php"; 
$conexion= conexion();
echo 'Resultado';
$cedula = $_POST['cedula'];

$bill = mysqli_query($conexion, "SELECT * FROM  `ubicacion` WHERE  `cedulaafiliado` LIKE '$cedula'") or die(mysqli_error($conexion));
while ($row = $bill->fetch_assoc()) {
	echo '<h2>Ubicación:</h2>
	 <br>CAJA: '.$row['ncaja'].
	'<br>PASILLO: '.$row['pasillo'].
	'<br>ESTANTE: '.$row['estante'].
	'<br>ENTREPAÑO: '.$row['entrepano'].
	'<br>FILA: '.$row['fila'].
	'<br>COLUMNA: '.$row['columna'];
}

?>

<style type="text/css">
#main{
	margin:80px auto;
	position:relative;
	width:40px;
	left: -49%;
}
</style>