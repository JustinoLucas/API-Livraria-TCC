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
    <link rel="stylesheet" href="/css/cadastro.css">
</head>

<body>
    <div class="wrapper">
        <div class="container-nav">
            <div class="imagens">
                <a href="/index.php"><img src="/img/open-book3.png" link="index.php" alt="" id="logo2-img"></a>
            </div>
            <p id="nome-logo">Estoque de Livros</p>
            <span class="usuario">Bem-Vindo(a) <?= $_SESSION['nome'] ?></span>
        </div>
        <div class="menu">
            <div class="menu-nav">
                <a href="estoque.php">Estoque</a>
                <a href="pesquisar-livro.php">Pesquisar</a>
                <a href="#">Cadastrar</a>
                <a href="movimento.php">Entrada & Saida</a>
                <a href="relatorio.php">Relatorio</a>
                <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
            </div>
            <div>
                <a href="/sair.php" id="btn-sair">Sair</a>
            </div>
        </div>
        <div>
            <div class="cadastro-livro">

                <h1>Cadastro de Livros</h1>
                <div class="tabela-cadastro">
                    <form method="POST" action="/proc/cadastrando-livro.php">
                        <table>
                            <tr>
                                <td>Nome do Livro: </td>
                                <td><input type="text" name="nomeLivro"></td>
                            </tr>
                            <tr>
                                <td>Nome do Autor: </td>
                                <td><input type="text" name="nomeAutor"></td>
                            </tr>
                            <tr>
                                <td>Categoria do Livro: </td>
                                <td><input type="text" name="categoriaLivro"></td>
                            </tr>
                            <tr>
                                <td>Editora do Livro: </td>
                                <td><input type="text" name="editoraLivro"></td>
                            </tr>
                            <tr>
                                <td>Ano de Publicação: </td>
                                <td><input type="date" name="dataLivro"></td>
                            </tr>
                            <tr>
                                <td>Imagem do Livro (600px / 422px): </td>
                                <td><input type="text" name="imgLivro" placeholder="URL da Imagem"></td>
                            </tr>
                            <tr>
                                <td>Sinopse do Livro: </td>
                                <td><input type="text" name="sinopseLivro"></td>
                            </tr>
                        </table>
                        <input type="submit" value="Cadastrar Livro" id="btn-cadastrar">
                        <button id="btn-limpar" type="reset" value="Voltar"><img id="img-limpar" src="/img/limpar.png" alt=""></button>
                    </form>
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