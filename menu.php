<?php 
session_start();
$cedula = $_SESSION['id'];
$tipousuario = $_SESSION['tipo'];

//conexion base de datos para dar resultado a la seccion del menu
require_once('conexion.php');
$db_connection = conexion();
$bill_user = mysqli_query($db_connection,"SELECT * FROM usuarios WHERE ncedula = '$id' ") or die(mysqli_error($db_connection));
$row = $bill_user->fetch_assoc();
$nombre = $row['nombre'];
$apellido = $row['apellido'];
$cargo = $row['cargo'];
$ntelefono = $row['ntelefono'];
$tipo = $row['tipo'];
        
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS3 Minimalistic Navigation Menu | Tutorialzine demo</title>

<link rel="stylesheet" type="text/css" href="styles.css" />
<link rel="stylesheet" type="text/css" href="style.css" />

<div id="logo"> <img src="helpfile.jpeg"></div>
<section id="menusection">
    <form method="post" action="">
        <label>Hola </label><?php echo $nombre.' '; echo $apellido.' <br>';?><label>Veo que eres </label><?php echo $cargo;?><br>
        <label>WAKUSOFT esta encantado de Trabajar contigo <br>
        <label>Recuerda solo podrás tener acceso a las opciones que el menú muestre ya que eres usuario tipo </label><?php echo $tipo;?>
    </form>
</section>

<section id="seccionmain"><img src="logo-wakusoft2.png"></section>
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



<style type="text/css">
body{
    font-family: sans-serif;
    font-size: 20px;
}
#seccionmain{
    position: absolute;
    left: 40%;
    top: 30%;
}
#seccionmain img{
    width: 50%;
}
</style>