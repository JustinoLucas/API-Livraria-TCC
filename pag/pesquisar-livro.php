<?php 

include('../config/protecao.php');

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/pesquisar.css">
    
</head>
<body>
	<div class="container-nav">
		<div class="imagens">
			<a href="/index.php"><img src="/img/open-book3.png" link="index.php"	alt="" id="logo2-img"></a>
		</div>
		<p id="nome-logo">Estoque de Livros</p>
		<span class="usuario">Bem-Vindo(a) <?= $_SESSION['nome'] ?></span>
	</div>
	<div class="menu">
		<div class="menu-nav">
			<a href="estoque.php">Estoque</a>
			<a href="#">Pesquisar</a>
			<a href="cadastrar-livro.php">Cadastrar</a>
			<a href="movimento.php">Entrada & Saida</a>
            <a href="relatorio.php">Relatorio</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?> >Gerenciar Funcionarios</a>
		</div>
		<div>
			<a href="/sair.php" id="btn-sair">Sair</a>
		</div>
	</div>
    <div class="pesquisar-livro">
        <div><h1 class="titulo">Pesquisar Livro</h1></div>
        <div class="pesquisa">
            <form method="POST" action="/proc/procurando-livro.php">
                <div>
                    <p id="id-procura">ID do Livro:</p>
                    <input type="text" name="idLivro" placeholder="ID" id="btn-texto">
                </div>
                    <input type="submit" value="Pesquisar" id="btn-pesquisar">
            </form>
        </div>
    </div>
    <footer>
		<div>
			Lucas Justino Turatto ©
		</div>
	</footer>
</body>
</html>

