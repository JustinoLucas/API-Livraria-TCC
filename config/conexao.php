<?php 

// ** MySQL Settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'nomedb');

/** MySQL database username */
define('DB_USER', 'usernamedb');

/** MySQL database password */
define('DB_PASSWORD', 'passdb');

/** MySQL hostname */
define('DB_HOST', 'ipdb');

$hostname = "localhost";
$bancodedados = "estoque_livro";
$usuario = "root";
$senha = "";

$mysqli = new mysqli($hostname, $usuario, $senha, $bancodedados);

if($mysqli->connect_errno) {
    echo "Falha ao conectar!: ( ". $mysqli->connect_errno . " ) " . $mysqli->connect_error;
    exit();
}



?>
