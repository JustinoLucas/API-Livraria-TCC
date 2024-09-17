<?php

include('../config/protecao.php');

$_SESSION['ID'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/erros.css">
</head>

<body>
    <div class="container-nav">
        <div class="imagens">
            <a href="/index.php"><img src="/img/open-book3.png" link="index.php" alt="" id="logo2-img"></a>
        </div>
        <p id="nome-logo">Estoque de Livros</p>
        <span class="usuario">Bem-Vindo(a) <?= $_SESSION['nome'] ?></span>
    </div>
    <div class="menu">
        <div class="menu-nav">
            <a href="/pag/estoque.php">Estoque</a>
            <a href="/pag/pesquisar-livro.php">Pesquisar</a>
            <a href="/pag/cadastrar-livro.php">Cadastrar</a>
            <a href="/pag/movimento.php">Entrada & Saida</a>
            <a href="/pag/relatorio.php">Relatorio</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
        </div>
        <div>
            <a href="/sair.php" id="btn-sair">Sair</a>
        </div>
    </div>
    <div class="pesquisando-livro">
        <h1></h1>
        <div>
            <?php
            if (isset($_SESSION['ID'])) {
                $id = $_SESSION['ID'];
                require_once '../config/conexao.php';

                $mysqli->set_charset("utf8");

                $sql = "DELETE FROM `livros` WHERE id='$id';";
                

                if ($mysqli->query($sql) === TRUE) {
                    echo '<div class="sucesso">Deletado com sucesso!</div>';
                } else {
                    echo "Erro :" . $sql . "<br>" . $mysqli->error;
                }
                $mysqli->close();
            } else {
                echo '<div class="erro">Campo obrigatorio nao preenchido!</div>';
            }
            ?>
        </div>
    </div>
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>
</body>

</html>