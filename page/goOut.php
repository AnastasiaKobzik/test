<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();

// стираем cookie идентификатора сессии
if (isset($_COOKIE[session_name()])) 
{
	setcookie(session_name(), '', time()-42000, '/');
}

if ($_SESSION['nameUser'] != '') {
	unset($_SESSION['nameUser']);
}
session_destroy();
?>