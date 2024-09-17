<?php

include('../config/protecao.php');
date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/movimento.css">
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
			<a href="pesquisar-livro.php">Pesquisar</a>
			<a href="cadastrar-livro.php">Cadastrar</a>
			<a href="#">Entrada & Saida</a>
            <a href="relatorio.php">Relatorio</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?> >Gerenciar Funcionarios</a>
		</div>
		<div>
			<a href="/sair.php" id="btn-sair">Sair</a>
		</div>
	</div>
    <div class="movimento">
        <h1>Entrada e Saida de Livros</h1>
        <div class="form-movimento">
            <form action="/proc/movimentando-livro.php" method="POST">
                <table>
                    <tr>
                        <td><h2>Tipo</h2></td>
                        <td><input type="radio" name="tipoMovi" value="Entrada"> Entrada</td>
                        <td><input type="radio" name="tipoMovi" value="Saida"> Saida</td>
                    </tr>
                    <tr>
                        <td><h3>ID do Livro:</h3></td>
                        <td><input type="text" name="idLivro"></td>
                    </tr>
                    <tr>
                        <td><h3>Quantidade:</h3></td>
                        <td><input type="text" name="quantidadeLivro"></td>
                    </tr>
                    <tr>
                        <td><h3>Data:</h3></td>
                        <td><input type="date" name="dataHoje" value="<?php $data = date('d/m/Y'); echo $data;?>"></td>
                    </tr>
                    <tr>
                        <td><h3>Hora:</h3></td>
                        <td><input type="text" name="horaHoje" value="<?php $hora = date('H:i'); echo $hora;?>"></td>
                    </tr>
                </table>
                <input id="btn-salvar" type="submit" value="Salvar">
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

