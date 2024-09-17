<?php

ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

if(!isset($_SESSION)){
	session_start();
}

// if(!isset($_SESSION['id-usuario'])){
//     die(header('Location: ../../../login.php'));
// }


$nivel = $_SESSION['nivel'];

if($nivel === '0'){
	$btn_disabled = 'style="display:none;"';
} else{
    $btn_disabled = '';
}