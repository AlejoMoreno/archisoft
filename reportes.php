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
	<h1>Enterate de todo</h1><hr>
	<br><br>

	<?php 
	require_once('conexion.php');
	$db_connection = conexion();

	//historial
	$bill_historial = mysqli_query($db_connection,"SELECT * FROM  `historial` ORDER BY  `historial`.`fecha` ASC ") or die(mysqli_error($db_connection));
	echo '<h3 id="1">HISTORIAL CONEXION POR USUARIO</h3>
		<table id="t1" class="tg">
		  <tr>
		    <th class="tg-2fs7">Usuario</th>
		    <th class="tg-2fs7">Ip</th>
		    <th class="tg-2fs7">Fecha</th>
		  </tr>';
	while ($row = $bill_historial->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['iduser'].'</td>
		    <td class="tg-iacq">'.$row['ip'].'</td>
		    <td class="tg-iacq">'.$row['fecha'].'</td>
		  </tr>';
	}
	echo '</table>';

	?>

	<h3 id="2">USUARIOS DEL SISTEMA</h3>
	<?php 
	$bill_usuarios = mysqli_query($db_connection,"SELECT * FROM  `usuarios` ") or die(mysqli_error($db_connection));
	echo '
		<table id="t2" class="tg">
		  <tr>
		    <th class="tg-2fs7">Cédula</th>
		    <th class="tg-2fs7">Nombre</th>
		    <th class="tg-2fs7">Tipo</th>
		    <th class="tg-2fs7">Cargo</th>
		    <th class="tg-2fs7">Teléfono</th>
		    <th class="tg-2fs7">Clave</th>
		  </tr>';
	while ($row = $bill_usuarios->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['ncedula'].'</td>
		    <td class="tg-iacq">'.$row['nombre'].' '.$row['apellido'].'</td>
		    <td class="tg-iacq">'.$row['tipo'].'</td>
		    <td class="tg-iacq">'.$row['cargo'].'</td>
		    <td class="tg-iacq">'.$row['ntelefono'].'</td>
		    <td class="tg-iacq">'.$row['clave'].'</td>
		  </tr>';
	}
	echo '</table>';

	?>


	<h3 id="3">REGISTRO POR USUARIO</h3>
	<?php 
	$bill_registrousuario = mysqli_query($db_connection,"SELECT ncedula, COUNT( * ) AS cuenta FROM ubicacion GROUP BY ncedula ") or die(mysqli_error($db_connection));
	echo '
		<table id="t3" class="tg">
		  <tr>
		    <th class="tg-2fs7">Cédula</th>
		    <th class="tg-2fs7">Cantidad de carpetas</th>
		  </tr>';
	while ($row = $bill_registrousuario->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['ncedula'].'</td>
		    <td class="tg-iacq">'.$row['cuenta'].'</td>
		  </tr>';
	}
	echo '</table>';

	?>


	<h3 id="4">CUANTAS CARPETAS HIZO EN LA FECHA</h3>
	<?php 
	$bill_registros = mysqli_query($db_connection,"SELECT ncedula, COUNT( * ) AS cuenta, ncaja, fecha FROM ubicacion GROUP BY ncedula, ncaja") or die(mysqli_error($db_connection));
	echo '
		<table id="t4" class="tg">
		  <tr>
		    <th class="tg-2fs7">Cédula</th>
		    <th class="tg-2fs7">Cantidad de carpetas</th>
		    <th class="tg-2fs7">Numero de Caja</th>
		    <th class="tg-2fs7">Fecha</th>
		  </tr>';
	while ($row = $bill_registros->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['ncedula'].'</td>
		    <td class="tg-iacq">'.$row['cuenta'].'</td>
		    <td class="tg-iacq">'.$row['ncaja'].'</td>
		    <td class="tg-iacq">'.$row['fecha'].'</td>
		  </tr>';
	}
	echo '</table>';

	?>


	<h3 id="5">CUANTOS CAJAS HIZO EN LA FECHA</h3>
	<?php 
	$bill_regcaja = mysqli_query($db_connection,"SELECT ncedula, ncaja, COUNT( ncaja ) AS cuenta FROM  `ubicacion` GROUP BY  `ncaja` ") or die(mysqli_error($db_connection));
	echo '
		<table id="t5" class="tg">
		  <tr>
		    <th class="tg-2fs7">Cédula</th>
		    <th class="tg-2fs7">Numero de Caja</th>
		    <th class="tg-2fs7">Cantidad de cajas</th>
		  </tr>';
	while ($row = $bill_regcaja->fetch_assoc()) {
		echo '<tr>
		    <td class="tg-iacq">'.$row['ncedula'].'</td>
		    <td class="tg-iacq">'.$row['ncaja'].'</td>
		    <td class="tg-iacq">'.$row['cuenta'].'</td>
		  </tr>';
	}
	echo '</table>';

	?>

	






</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script> 
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$(document).ready(function(){
  $('#t1').hide();
  $('#t2').hide();
  $('#t3').hide();
  $('#t4').hide();
  $('#t5').hide();
});
$('#1').click(function(){
  $('#t1').show(1000);
});
$('#2').click(function(){
  $('#t2').show(1000);
});
$('#3').click(function(){
  $('#t3').show(1000);
});
$('#4').click(function(){
  $('#t4').show(1000);
});
$('#5').click(function(){
  $('#t5').show(1000);
});

$('#1').dblclick(function(){
  $('#t1').hide(1000);
});
$('#2').dblclick(function(){
  $('#t2').hide(1000);
});
$('#3').dblclick(function(){
  $('#t3').hide(1000);
});
$('#4').dblclick(function(){
  $('#t4').hide(1000);
});
$('#5').dblclick(function(){
  $('#t5').hide(1000);
});
</script>



<style type="text/css">
#main{
	margin:80px auto;
	position:relative;
	width:40px;
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
.tg .tg-iacq{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;background-color:#ddddee;vertical-align:top}
.tg .tg-2fs7{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;background-color:#303498;color:#ffffff;text-align:center;vertical-align:top}
.tg .tg-sn89{font-size:20px;font-family:Verdana, Geneva, sans-serif !important;;vertical-align:top}
</style>