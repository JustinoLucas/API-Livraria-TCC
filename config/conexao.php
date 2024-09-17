<?php 

// ** MySQL Settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'justi512_estoque_livros');

/** MySQL database username */
define('DB_USER', 'justi512_lucas');

/** MySQL database password */
define('DB_PASSWORD', 'wl=eOGh+&A3@');

/** MySQL hostname */
define('DB_HOST', '192.185.176.15');

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