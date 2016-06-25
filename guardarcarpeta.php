<?php 
session_start(); 
$ncedula = $_SESSION['id'];
include_once "conexion.php"; 
$conexion= conexion();
$time = time();
$fecha = date("d-m-Y (H:i:s)", $time);

//TOMA DE DATOS FORMULARIO ANTERIOR 
$caja = $_POST['codigocaja'];
$codigobarras = $_POST['codigocarpeta'];
$pasillo=$_POST['pasillo'];
$entrepano =$_POST['entrepanos'];
$estante =$_POST['estante'];
$fila =$_POST['fila'];
$columna = $_POST['columna'];

//FRAGMENTAR CODIGO DE CARPETAS PARA REGISTRAR CAJA CEDULA CARPETA
//fragmentos es un arreglo [] que se usa como comidin del codigo de barras donde se parte por el numero de la caja 805
$fragmentos = split($caja, $codigobarras);
//cedulaCompleta es el resultado del primer pedazo de fragmentos[] = C000113868060
$cedulaCompleta = $fragmentos[0];
//carpeta es el resultado del segundo pedazo de fragmentos[] = 09
$carpeta = $fragmentos[1];
//cedula es un arreglo que almacenará unicamente la cedula partiendo el string en donde contenga la letra C
$cedula = split('C', $cedulaCompleta);
//numerocedula es el resultado del primer pedazo de cedula = 113868060
$numeroCedula = intval($cedula[1]);

$ncaja = substr($caja,-4);

echo '<br>Este es el codigo de barras que ingresa al sistema con la pistola = '.$codigobarras;
echo '<br>Este es el codigo de la caja el cual se tiene que ingresar de primeras = '.$ncaja;
echo '<br>Esta es la cedula = '.$numeroCedula;
echo '<br>Esta es la carpeta = '.$carpeta;

if($codigobarras != ''){
 	$sql = "INSERT INTO `ubicacion` 
	  VALUES (null,
	  '$caja',
	  '$ncedula',
	  '$fecha',
	  '$codigobarras',
	  '$ncaja',
	  '$carpeta',
	  '$numeroCedula',
	  '$pasillo',
	  '$estante',
	  '$entrepano',
	  '$fila',
	  '$columna')";
    mysqli_query($conexion, $sql) or die(mysqli_error($conexion));  

    echo 'Usted se ha registrado correctamente.'; 
}

?>