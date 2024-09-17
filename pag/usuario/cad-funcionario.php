<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id-usuario'])) {
    die(header('Location: ../../../../login.php'));
}

$nivel = $_SESSION['nivel'];

if ($nivel === '0') {
    die(header('Location: ../../../index.php'));
}

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
    <script src="/js/script.js"></script>

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
            <a href="cad-funcionario.php">Cadastrar Funcionario</a>
            <a href="alte-funcionario.php">Alterar Funcionario</a>
            <a href="exc-funcionario.php">Excluir Funcionario</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario">Gerenciar Funcionarios</a>
        </div>
        <div>
            <a href="/sair.php" id="btn-sair">Sair</a>
        </div>
    </div>
    <div class="cadastro-livro">
        <h1 id="titulo">Cadastrar Funcionario</h1>
        <div class="tabela-cadastro">
            <form method="POST" action="procUsuario/cadastrando-usuario.php">
                <table>
                    <tr>
                        <td>Nome: </td>
                        <td><input type="text" name="nomeFunc"></td>
                    </tr>
                    <tr>
                        <td>Login: </td>
                        <td><input type="text" name="loginFunc"></td>
                    </tr>
                    <tr>
                        <td>Senha: </td>
                        <td><input type="password" name="senhaFunc"></td>
                    </tr>
                    <tr>
                        <td>Idade: </td>
                        <td><input type="date" name="idadeFunc"></td>
                    </tr>
                    <tr>
                        <td>Função: </td>
                        <td><input type="text" name="funcaoFunc"></td>
                    </tr>
                    <tr>
                        <td>Enredeço: </td>
                        <td><input type="text" name="endereFunc"></td>
                    </tr>
                    <tr>
                        <td>Telefone: </td>
                        <td><input type="text" name="telefFunc" onkeyup="handlePhone(event)"></td>
                    </tr>
                </table>
                <input type="submit" value="Cadastrar Funcionario" id="btn-cadastrar">
                <button id="btn-limpar" type="reset" value="Voltar"><img id="img-limpar" src="/img/limpar.png" alt=""></button>
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