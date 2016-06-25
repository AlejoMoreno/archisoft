<?php
	session_start();
	require_once('conexion.php');

	 if(isset($_POST['username']) && isset($_POST['password'])){ 
		login();		
	}

	function login()
	{
		$username=$_POST['username'];
		$password=$_POST['password'];

		$db_connection = conexion();
		$bill_user = mysqli_query($db_connection,"SELECT * FROM usuarios WHERE ncedula = '$username' AND clave = '$password'") or die(mysqli_error($db_connection));
		
		if($bill_user->num_rows == 0){
			echo 'El usuario y/o la contraseña son incorrectos. Por favor verifique los datos';
			exit();
		}

		elseif ($bill_user->num_rows == 1) {
			while ($row = $bill_user->fetch_assoc()) {
				$id=$row['ncedula'];
				$_SESSION['id'] = $row["ncedula"];
				$_SESSION['tipo'] = $row["tipo"];
			}
			//echo 'Bienvenido'.$id;
			
			//echo "<script type='text/javascript'>
			//windows.location = 'registroinventario.php';
			/*</script>";*/
			$ip = getRealIP();
			$hoy = date("Y-m-d"); 
			$historial = "INSERT INTO historial (`idhistorial`, `iduser`, `ip`, `fecha`) VALUES (null,  '$id',  '$ip',  '$hoy');";
			mysqli_query($db_connection, $historial) or die(mysqli_error($db_connection)); 
			echo 'Bienvenido'.$id;
			
			echo "<script type='text/javascript'>
				window.open('menu.php', 'MsgWindow', 'width=800%, height=600');
			</script>";
			exit();
						
			
		}

		

		mysqli_close($db_connection);

	}

	function getRealIP() {
	 
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
	}

?>