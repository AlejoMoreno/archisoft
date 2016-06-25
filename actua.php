<?php 

	session_start(); 
	include_once "conexion.php"; 
	$conexion= conexion();
    
?>


<form action="" method="post" class="registro">

<div><label>Numero de cedula carpeta:</label> 
<input type="text" name="idcaja"></div> &nbsp;

<input type="submit" name="enviar1" value="Consulta carpeta"><input type="submit" name="ubicaja" value="Cambiar ubicacion caja"</div> &nbsp;
    
	</form>   
    
    
    <?php 

 
if(isset($_POST['enviar1'])){ 
	if(isset($_POST['ubicaja'])) { 
		if( $_POST['idcaja'] == '') { 
			echo 'Por favor llene todos los campos.'; 
		} 
		else { 
			$idcaja = $_POST['idcaja'];
			$bill_contenedor = mysqli_query($conexion,"SELECT * FROM ubicacion where codigocaja = '$idcaja'") or die(mysqli_error($conexion));
			$row = $bill_contenedor->fetch_assoc();
			$idubicacion = $row['idubicacion'];
			$codigocaja = $row['codigocaja'];
			$ncedula = $row['ncedula'];
			$fecha	= $row['fecha'];
			$codigocarpeta = $row['codigocarpeta'];
			$ncaja = $row['ncaja'];
			$ncarpeta = $row['ncarpeta'];
			$cedulaafiliado = $row['cedulaafiliado'];
			$nivel = $row['nivel'];
			$pasillo = $row['pasillo'];
			$estante = $row['estante'];
			$entrepano = $row['entrepano'];
			$fila = $row['fila'];
	  	    $columna = $row['columna'];
	  	    $piso = $row['piso'];

	  	    //consulta tabla lineas				 
			echo '<form action="" method="post" class="registro">
			<label> Codigo de la caja:</label>
			<input name="codigocaja" value = "'.$codigocaja.'"type="text" />';	
			
			echo '<label>Nivel:</label>
			<input name="nivel" value = "'.$nivel.'"type="text" />';
			
			echo '<label>Pasillo:</label>
			<input name="pasillo" value = "'.$pasillo.'"type="text" />';

			echo '<label>Estante:</label>
			<input name="estante" value = "'.$estante.'"type="text" />';

			echo '<label>Entrepaño:</label>
			<input name="entrepano" value = "'.$entrepano.'"type="text" />';

			echo '<label>Fila:</label>
			<input name="fila" value = "'.$fila.'"type="text" />';

			echo '<label>Columna:</label>
			<input name="columna" value = "'.$columna.'"type="text" />';
			
			echo '<label>Piso:</label>
			<input name="piso" value = "'.$piso.'"type="text" />
			<input type="submit" name="actualizar2" value="Actualizar carpeta"></div> &nbsp; <input type="submit" name="borrar2" value="Borrar">
			
			</form>';
		}
	}

	if(isset($_POST['actualizar2'])){
		if(	  			
			$_POST['codigocaja'] == '' or 
			$_POST['nivel'] == '' or
			$_POST['pasillo'] == '' or
			$_POST['estante'] == '' or
			$_POST['entrepano'] == '' or
			$_POST['fila'] == '' or
			$_POST['columna'] == '' or
			$_POST['piso'] == '') 
		{ 
	        echo 'Por favor llene todos los campos.'; 
	    } 
	    else { 		    	
			$codigocaja = $_POST['codigocaja'];
			$nivel = $_POST['nivel'];
			$pasillo = $_POST['pasillo'];
			$estante = $_POST['estante'];
			$entrepano = $_POST['entrepano'];
			$fila = $_POST['fila'];
	  	    $columna = $_POST['columna'];
	        $piso = $_POST['piso'];

	        $sql = "UPDATE `ubicacion` SET 		  
			  `codigocaja` = '$codigocaja', 
			  `nivel` = '$nivel',
			  `pasillo` = '$pasillo',
			  `estante` = '$estante',
			  `entrepano` = '$entrepano',
			  `fila` = '$fila',
			  `columna` = '$columna',
			  `piso` = '$piso' WHERE `ubicacion`.`codigocaja` = '$codigocaja'";
	       
	        mysqli_query($conexion, $sql) or die(mysqli_error($conexion)); 
	  		echo 'Usted se ha actualizado correctamente.';
	  	}
	}
	else {
		if(isset($_POST['borrar2'])){
			if( 				 
				$_POST['codigocaja'] == '' or 
				$_POST['nivel'] == '' or
				$_POST['pasillo'] == '' or
				$_POST['estante'] == '' or
				$_POST['entrepano'] == '' or
				$_POST['fila'] == '' or
				$_POST['columna'] == '' or
				$_POST['piso'] == '')
		    { 
		        echo 'Por favor llene todos los campos.'; 
		    } 
		    else { 	
		    	$codigocaja = $_POST['codigocaja'];
				$nivel = $_POST['nivel'];
				$pasillo = $_POST['pasillo'];
				$estante = $_POST['estante'];
				$entrepano = $_POST['entrepano'];
				$fila = $_POST['fila'];
		  	    $columna = $_POST['columna'];
		        $piso = $_POST['piso'];

		        $sql = "DELETE FROM `ubicacion` WHERE `ubicacion`.`codigocaja` = '$codigocaja'";
		        mysqli_query($conexion, $sql) or die(mysqli_error($conexion));  
		        echo 'Usted a eliminado correctamente la caja.'; 
		    }
		}
	}
	
}

						 ?>
