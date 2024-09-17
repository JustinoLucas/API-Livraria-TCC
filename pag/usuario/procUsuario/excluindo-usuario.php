<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id-usuario'])) {
    die(header('Location: ../../../../login.php'));
}

$nivel = $_SESSION['nivel'];

if ($nivel === '0') {
    die(header('Location: ../../../../index.php'));
}

$_SESSION['idFunc'];

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
    <link rel="stylesheet" href="/css/procurado.css">
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
            <a href="/pag/usuario/cad-funcionario.php">Cadastrar Funcionario</a>
            <a href="/pag/usuario/alte-funcionario.php">Alterar Funcionario</a>
            <a href="/pag/usuario/exc-funcionario.php">Excluir Funcionario</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario">Gerenciar Funcionarios</a>
        </div>
        <div>
            <a href="/sair.php" id="btn-sair">Sair</a>
        </div>
    </div>
    <div class="pesquisando-livro">
        <h1></h1>
        
            <?php
            if (isset($_SESSION['idFunc'])) {
                $id = $_SESSION['idFunc'];
                require_once '../../../config/conexao.php';

                $mysqli->set_charset("utf8");

                $sql = "DELETE FROM `usuarios` WHERE id='$id';";

                if ($mysqli->query($sql) === TRUE) {
                    echo '<div class="sucesso">Funcionario Deletado com sucesso!</div>';
                } else {
                    echo "Erro :" . $sql . "<br>" . $mysqli->error;
                }
                $mysqli->close();
            } else {
                echo '<div class="erro">Campo obrigatório não preenchido!</div>';
            }
            ?>
        
    </div>
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>

</body>

</html>