<?php 
session_destroy();
$parametros_cookies = session_get_cookie_params(); 
setcookie(session_name(),0,1,$parametros_cookies["path"]);

echo "<script type='text/javascript'> function redireccionar(){window.location = 'index.php?variable=entradas';} 
	setTimeout ('redireccionar()', 1000);</script>";
?>