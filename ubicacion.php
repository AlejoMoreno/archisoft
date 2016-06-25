<?php 
session_start();
$tipousuario = $_SESSION['tipo'];


$entrepanos = $HTTP_GET_VARS["entrepanos"];
$nivel = $HTTP_GET_VARS["nivel"];
$pasillo = $HTTP_GET_VARS["pasillo"];
$estante = $HTTP_GET_VARS["estante"];
$fila = $HTTP_GET_VARS["fila"];
$columna = $HTTP_GET_VARS["columna"];
$codigocaja = $HTTP_GET_VARS["codigocaja"];

require_once('conexion.php');
$conexion = conexion();
$bill = mysqli_query($conexion,"SELECT ncaja, COUNT(*) AS cuenta FROM ubicacion where ncaja like '$codigocaja' GROUP BY ncaja") or die(mysqli_error($conexion));
while ($row = $bill->fetch_assoc()) {
	echo '<div id="mostrarcajas"><label> En la caja '.$row['ncaja'].' se registraron '.$row['cuenta'].' CARPETAS.</label></div>';
}

?>

<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="styles.css">
</head>

<div id="logo"> <img src="helpfile.jpeg"></div>
<div id="main">
<ul id="navigationMenu">
	<li><a class="home" href="menu.php"><span>Inicio</span></a></li>
	<?php

	if($tipousuario=='administrador'){
		echo '    
    <li><a class="about" href="ubicacion.php"><span>Empieza a trabajar</span></a></li>
    <li><a class="services" href="buscar.php"><span>Encuentra tus carpetas</span></a></li>    
    <li><a class="portfolio" href="reportes.php"><span>Enterate de todo</span></a></li>   
    <li><a class="contact" href="salida.php"><span>Termina de trabajar</span></a></li>';
	}
	elseif ($tipousuario=='usuario') {
		echo '<li><a class="home" href="menu.php"><span>Inicio</span></a></li>    
    <li><a class="about" href="ubicacion.php"><span>Empieza a trabajar</span></a></li> ';  
    
	}

	?>
    <li><a class="contact" href="salida.php"><span>Termina de trabajar</span></a></li>
</ul>
</div>

<div id="formulario">
	<center><h1>UBICACIÓN CAJA</h1><hr></center>
	<p>Ubica la caja en un espacio en la bodega según las siguientes caracteristicas:</p>
	<form action="registrocarpeta.php" method="post" class="registro">
		<input name="piso" id="piso" type="text" value="<?php echo $piso;?>" placeholder="Piso ubicación" /><span class="info">Piso</span>
		<input name="pasillo" id="pasillo" type="text" value="<?php echo $pasillo;?>" placeholder="pasillo ubicación" /><span class="info">Pasillo</span>
		<input name="estante" id="estante" type="text" value="<?php echo $estante;?>" placeholder="estante ubicación" /><span class="info">Estante</span>
		<input name="entrepanos" id="entrepanos" type="text" value="<?php echo $entrepanos;?>" placeholder="entrepaño ubicación"/><span class="info">Entrepaño</span>
		<input name="fila" id="fila" type="text" value="<?php echo $fila;?>" placeholder="fila ubicación" /><span class="info">Fila</span>
		<input name="columna" id="columna" type="text" value="<?php echo $columna;?>" placeholder="columna ubicación" /><span class="info">Columna</span>
		<input name="nivel" id="nivel" type="text" value="<?php echo $nivel;?>" placeholder="Nivel ubicación" /><span class="info">Nivel</span>
		<input name="codigocaja" id="codigocaja" placeholder="codigo caja" type="text" /><span class="info">Código Barras Caja</span>
		<input type="submit" id="boton" name="enviar" value="Registrar">
	</form>
</div>



<?php 
	require_once('conexion.php');
	$db_connection = conexion();
	//historial
	$bill_historial = mysqli_query($db_connection,"SELECT * from `ubicacion` where  `ncaja` = '$codigocaja'  ") or die(mysqli_error($db_connection));
	echo '<div id="mostrarcajas1">
		<table id="t1" class="tg">
		  <tr>
		    <th class="tg-2fs7">Numero de caja </th>
		    <th class="tg-2fs7"> Numero carpeta</th>
		  </tr>';
	while ($row = $bill_historial->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['ncaja'].'</td>
		    <td class="tg-iacq">'.$row['ncarpeta'].'</td>
		    
		  </tr>';
	}
	echo '</table></div>';

	?>






<style type="text/css">
#main{
	margin:80px auto;
	position:relative;
	width:40px;
	left: -49%;
}
#mostrarcajas{
	position: relative;
	top: 80px;
	left: 20%;
	z-index: 10;
}

#mostrarcajas1{
	position: relative;
	top: 400px;
	left: 20%;
	z-index: 10;
}
</style>






<style type="text/css">
#main{
	margin:80px auto;
	position:relative;
	width:200px;
	left: -49%;
}
h3{
	color: white;
}
</style>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:20px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:20px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-iacq{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;background-color:#ffffff;vertical-align:top}
.tg .tg-2fs7{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;background-color:#336391;color:#ffffff;text-align:center;vertical-align:top}
.tg .tg-sn89{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;vertical-align:top}
</style>