<?php


// Incluir arquivos

include('config/protecao.php');
require_once('config/conexao.php');

// Verificar se o usuario esta logado se não volta para o login
if(!isset($_SESSION['id-usuario'])){
    die(header('Location: login.php'));
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Estoque de Livros</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/principal.css">
</head>

<body>
	<div>
		<div class="container-nav">
			<div class="imagens">
				<a href="#"><img src="img/open-book3.png" link="index.php" alt="" id="logo2-img"></a>
			</div>
			<p id="nome-logo">Estoque de Livros</p>
			<span class="usuario">Bem-Vindo(a) <?= $_SESSION['nome'] ?></span>
		</div>
		<div class="menu">
			<div class="menu-nav">
				<a href="pag/estoque.php">Estoque</a>
				<a href="pag/pesquisar-livro.php">Pesquisar</a>
				<a href="pag/cadastrar-livro.php">Cadastrar</a>
				<a href="pag/movimento.php">Entrada & Saida</a>
				<a href="pag/relatorio.php">Relatorio</a>
				<a href="pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
			</div>
			<div>
				<a href="sair.php" id="btn-sair">Sair</a>
			</div>
		</div>
		<div class="container">
			<div class="wrapper">
				<h1>Painel</h1>
				<div class="container-index">
					<div class="container-item1">
						<div id="caixinha">
							<h2>Estoque total</h2>
						</div>
						<?php

						$sql = "SELECT sum(quantidade_estoque) FROM livros;";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalEst = $lista['sum(quantidade_estoque)'] . ' de livros';

						?>
						<div id="caixinha2">
							<h3><?php echo $totalEst ?></h3>
						</div>
					</div>
					<div class="container-item1">
						<div id="caixinha">
							<h2>Livros Cadastrados</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(*) FROM livros";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalCad = $lista['COUNT(*)'];

						?><div id="caixinha2">
							<h3><?php echo $totalCad ?></h3>
						</div>
					</div>
					<div class="container-item1">
						<div id="caixinha">
							<h2>Autores</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(DISTINCT autor_livro) FROM livros";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalAut = $lista['COUNT(DISTINCT autor_livro)'];

						?><div id="caixinha2">
							<h3><?php echo $totalAut ?></h3>
						</div>
					</div>
				</div>
				<div class="container-index">
					<div class="container-item1">
						<div id="caixinha">
							<h2>Categorias</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(DISTINCT categoria_livro) FROM livros";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalCat = $lista['COUNT(DISTINCT categoria_livro)'];

						?><div id="caixinha2">
							<h3><?php echo $totalCat ?></h3>
						</div>
					</div>
					<div class="container-item1">
						<div id="caixinha">
							<h2>Editoras</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(DISTINCT editora_livro) FROM livros";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalEdi = $lista['COUNT(DISTINCT editora_livro)'];

						?><div id="caixinha2">
							<h3><?php echo $totalEdi ?></h3>
						</div>
					</div>
				</div>
				<div class="container-index">
					<div class="container-item1">
						<div id="caixinha">
							<h2>Entrada</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(*) FROM movimento WHERE tipo_movimento = 'Entrada'";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalEnt = $lista['COUNT(*)'] . ' no total';

						?><div id="caixinha2">
							<h3><?php echo $totalEnt ?></h3>
						</div>
					</div>
					<div class="container-item1">
						<div id="caixinha">
							<h2>Saida</h2>
						</div>
						<?php

						$sql = "SELECT COUNT(*) FROM movimento WHERE tipo_movimento = 'Saida'";
						$sql_query = $mysqli->query($sql);
						$lista = $sql_query->fetch_assoc();
						$totalSai = $lista['COUNT(*)'] . ' no total';

						?><div id="caixinha2">
							<h3><?php echo $totalSai ?></h3>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer>
			<div>
				Lucas Justino Turatto ©
			</div>
		</footer>
	</div>
</body>

</html>