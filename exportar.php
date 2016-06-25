<?php 

require_once('conexion.php');
$db_connection = conexion();
$bill_user = mysqli_query($db_connection,"SELECT codigocaja, ncedula, fecha, codigocarpeta, ncaja, ncarpeta, cedulaafiliado, pasillo, estante, entrepaño, fila, columna
INTO OUTFILE  'C:/archisoft.csv'
FIELDS TERMINATED BY  ','
OPTIONALLY ENCLOSED BY  ''
ESCAPED BY  ''
LINES TERMINATED BY  ''
FROM ubicacion") or die(mysqli_error($db_connection));

?>