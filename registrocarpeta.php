<?php 
session_start(); 
$ncedula = $_SESSION['id'];
$tipousuario = $_SESSION['tipo'];
include_once "conexion.php"; 
$conexion= conexion();
$time = time();
$fecha = date("d-m-Y (H:i:s)", $time);

//TOMA DE DATOS FORMULARIO ANTERIOR 
$caja = $_POST['codigocaja'];
$codigobarras = $_POST['codigocarpeta'];
$nivel=$_POST['nivel'];
$pasillo=$_POST['pasillo'];
$entrepano =$_POST['entrepanos'];
$estante =$_POST['estante'];
$fila =$_POST['fila'];
$columna = $_POST['columna'];
$piso = $_POST['piso'];

//verificar si existe una caja con el mismo codigo de barras
if(isset($_POST['codigocarpeta'])){
	$bill = mysqli_query($conexion,"SELECT * FROM  `ubicacion` WHERE  `codigocarpeta` LIKE  '$codigobarras'") or die(mysqli_error($conexion));
}
//FRAGMENTAR CODIGO DE CARPETAS PARA REGISTRAR CAJA CEDULA CARPETA
$ncaja = substr($caja,-4);
//fragmentos es un arreglo [] que se usa como comidin del codigo de barras donde se parte por el numero de la caja 805
//$fragmentos = split($ncaja, $codigobarras);
$sizeCodigoCarpeta = strlen($codigobarras);
//cedulaCompleta es el resultado del primer pedazo de fragmentos[] = C000113868060
//$cedulaCompleta = $fragmentos[0];
//carpeta es el resultado del segundo pedazo de fragmentos[] = 09
//$carpeta = $fragmentos[1];

if($sizeCodigoCarpeta<20){
	$carpeta = substr($codigobarras,$sizeCodigoCarpeta-2,$sizeCodigoCarpeta);
	$perimitidaCarpeta='SI';
}
else{
	echo 'El código exede los caracteres permitidos.';
	$perimitidaCarpeta='NO';
}
//cedula es un arreglo que almacenará unicamente la cedula partiendo el string en donde contenga la letra C
//$sizeFragmento = strlen($cedulaCompleta);
$cedula = substr($codigobarras,1,$sizeCodigoCarpeta-7);
//$cedula = split('C', $cedulaCompleta);
//numerocedula es el resultado del primer pedazo de cedula = 113868060
$numeroCedula = intval($cedula);



echo '<br>Hola el código de barras que ingreso la pistola fue <label> '.$codigobarras.'</label>';
echo '<br>Recuerda que la caja que estas ubicando es la número <label>'.$ncaja.'</label>';
echo '<br>Vimos que la carpeta pertenece a la cédula <label>'.$numeroCedula.'</label>';
echo '<br>Registraste la carpeta # <label>'.$carpeta.'</label>';



if($ncaja != '' and $pasillo !='' and $entrepano != '' and $estante !='' and $fila != '' and $columna != '' and $nivel != ''){
	if($bill->num_rows > 0 ){
		echo '<p id="error">La carpeta ya fue registrado</p><script>alert("La carpeta ya fue registrado");
		</script>';
	}
	elseif ($carpeta != '' and $codigobarras != '' and $perimitidaCarpeta == 'SI') {
		$sql = "INSERT INTO `ubicacion` 
	  VALUES (null,
	  '$caja',
	  '$ncedula',
	  '$fecha',
	  '$codigobarras',
	  '$ncaja',
	  '$carpeta',
	  '$numeroCedula',
	  '$nivel',
	  '$pasillo',
	  '$estante',
	  '$entrepano',
	  '$fila',
	  '$columna',
	  '$piso')";
	
    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));  

    echo '<script>alert("La carpeta que usted ingreso Fue '.$codigobarras.'");</script>'; 
	}
	else{
		echo '<p id="error">Ten Cuidado, No puedes ubicar una carpeta sin toda la información necesaria </p><script>alert("Faltan campos por diligenciar.");</script>';		
	}
 	
}
else{
	echo '<p id="error">Ten Cuidado, No puedes ubicar una carpeta sin toda la información necesaria </p><script>alert("Faltan campos por diligenciar.");window.location = "ubicacion.php?codigocaja='.$caja.'&nivel='.$nivel.'&pasillo='.$pasillo.'&entrepanos='.$entrepanos.'&estante='.$estante.'&fila='.$fila.'&columna='.$columna.'";</script>'; 
}



?>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="styles.css">
</head>

<div id="main">
<ul id="navigationMenu">
	<?php
   if($tipousuario=='administrador'){
		echo '<li><a class="home" href="menu.php"><span>Inicio</span></a></li>    
    <li><a class="about" href="ubicacion.php"><span>Empieza a trabajar</span></a></li>
    <li><a class="services" href="buscar.php"><span>Encuentra tus carpetas</span></a></li>    
    <li><a class="portfolio" href="reportes.php"><span>Enterate de todo</span></a></li>   
    <li><a class="contact" href="salida.php"><span>Termina de trabajar</span></a></li>';
	}
	elseif ($tipousuario=='usuario') {
		echo '<li><a class="home" href="menu.php"><span>Inicio</span></a></li>    
    <li><a class="about" href="ubicacion.php"><span>Empieza a trabajar</span></a></li>   
    <li><a class="contact" href="salida.php"><span>Termina de trabajar</span></a></li>';
	}

	?>
</ul>
</div>

<div id="formulario">
	<center><h1>REGISTRO CARPETA</h1><hr></center>	<p>Registre el código de barras de la carpeta:</p>
	<form action="" method="post" class="registro">
		<p>Estas en la Caja: <?php echo $caja;?></p>
	<?php echo '<input name="piso" id="piso" placeholder="piso" type="hidden" value="'.$piso.'" >';
	      echo '<input name="codigocaja" id="codigocaja" placeholder="codigocaja" type="hidden" value="'.$caja.'" >';
		  echo '<input name="nivel" id="nivel" placeholder="nivel" type="hidden" value="'.$nivel.'" >';
		  echo '<input name="pasillo" id="pasillo" placeholder="pasillo" type="hidden" value="'.$pasillo.'" >';
		  echo '<input name="entrepanos" id="entrepanos" placeholder="entrepanos" type="hidden" value="'.$entrepanos.'" >';
		  echo '<input name="estante" id="estante" placeholder="estante" type="hidden" value="'.$estante.'" >';
		  echo '<input name="fila" id="fila" placeholder="fila" type="hidden" value="'.$fila.'" >';
		  echo '<input name="columna" id="columna" placeholder="columna" type="hidden" value="'.$columna.'" >';
	?>
		<input name="codigocarpeta" id="codigocarpeta" placeholder="codigocarpeta" type="text" /><span class="info">Código Barras Carpeta</span>
		 <input type="submit" id="boton" name="enviar" value="Registrar"></div> &nbsp;
		 <?php echo '<a id="ref" href="ubicacion.php?codigocaja='.$ncaja.'&nivel='.$nivel.'&pasillo='.$pasillo.'&entrepanos='.$entrepanos.'&estante='.$estante.'&fila='.$fila.'&columna='.$columna.'&piso='.$piso.'"><br>Toma una caja nueva</a>';?>
		 
	</form>
</div>

<script>
	document.getElementById("codigocarpeta").focus();
</script>

<style type="text/css">
#main{
	margin:80px auto;
	position:relative;
	width:40px;
	left: -49%;
}
#error{
	color:red;
}
#ref{
	position: absolute;
	top: 80%;
}
</style>