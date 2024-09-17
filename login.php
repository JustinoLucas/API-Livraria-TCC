<?php

//Esconde os erros
// ini_set('display_errors','Off');
// ini_set('error_reporting', E_ALL );
// define('WP_DEBUG', false);
// define('WP_DEBUG_DISPLAY', false);

include 'config/conexao.php';

$divErro = 'style="display: none;"';

//Todo o sistema de Login
if (isset($_POST['login']) || isset($_POST['senhaLogin'])) {
	if (strlen($_POST['login']) == 0) {
		$divErro = 'style="display: visible;"';
		$erroLogin = '<h2 id="login-erro">Preencha seu Login</h2>';
	} else if (strlen($_POST['senhaLogin']) == 0) {
		$divErro = 'style="display: visible;"';
		$erroSenha = '<h2 id="senha-erro">Preencha sua Senha</h2>';
	} else {

		$login = $mysqli->real_escape_string($_POST['login']);
		$senha = $mysqli->real_escape_string($_POST['senhaLogin']);

		$sql = "SELECT * FROM usuarios WHERE login_usuario = '$login' LIMIT 1";

		$sql_query = $mysqli->query($sql) or die("Falha na execução do código SQL: " . $mysqli->error);

		$quantidade = $sql_query->num_rows;

		$usuario = $sql_query->fetch_assoc();

		if (password_verify($senha, $usuario['senha_usuario'])) {
			
			if ($quantidade == 1) {

				if (!isset($_SESSION)) {
					session_start();
				}

				$_SESSION['id-usuario'] = $usuario['id'];
				$_SESSION['nome'] = $usuario['nome_usuario'];
				$_SESSION['nivel'] = $usuario['nivel'];
				
				header('Location: index.php');
			}
		} else {
			$divErro = 'style="display: visible;"';
			$erroFalha = '<h2 id="falha-erro">Falha ao logar! Login ou Senha incorretos!</h2>';
		}
	}
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pagina</title>
	<link rel="stylesheet" href="css/login.css">
</head>

<body>
	<div class="box">
		<p id="nome-logo-login">Estoque de Livros</p>
		<img src="img/open-book3.png" alt="" id="logo2-img">
		<div class="error-login" <?php echo $divErro;?>><?php echo $erroLogin; echo $erroSenha; echo $erroFalha;?></div>
		<form method="POST" action="#">
			<div class="input-container">
				<input type="text" name="login" />
				<label>Login</label>
			</div>
			<div class="input-container">
				<input type="password" name="senhaLogin" />
				<label>Senha</label>
			</div>
			<button type="submit" class="btn">ENTRAR</button>
		</form>
	</div>
</body>

</html>