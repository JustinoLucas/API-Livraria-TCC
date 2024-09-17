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

$_SESSION['idFunc'] = $_POST["idFunc"];

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/funcionario.css">
    <link rel="stylesheet" href="/css/erros.css">
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

        if (isset($_POST["idFunc"])) {

            $id = $_POST["idFunc"];

            require_once '../../../config/conexao.php';

            $mysqli->set_charset("utf8");

            $sql = "SELECT * FROM `usuarios` WHERE id='$id';";

            $sql_query = $mysqli->query($sql);

            if ($sql_query->num_rows > 0) {
                while ($alterar = $sql_query->fetch_assoc()) {
                    $idFunc = $alterar["id"];
                    $nome = $alterar["nome_usuario"];
                    $login = $alterar["login_usuario"];
                    $endereco = $alterar["endereco_usuario"];
                    $telefone = $alterar["telefone_usuario"];
                    $funcao = $alterar["funcao_usuario"];
                    $data = $alterar["data_usuario"];
                    $nivel = $alterar["nivel"]; ?> 
                
                    <div class="fundo">
                        <form action="alterando-usuario.php" method="POST">
                            <div class="livro-info">
                                <p>ID:</p>
                                <input type="text" name="idFunc" value="<?= $idFunc ?>" disabled>
                                <p>Nome do Funcionario:</p>
                                <input type="text" name="nomeFunc" value="<?= $nome ?>">
                                <p>Login</p>
                                <input type="text" name="loginFunc" value="<?= $login ?>">
                                <p>Função</p>
                                <input type="text" name="funcaoFunc" value="<?= $funcao ?>">
                                <p>Data de Aniversário:</p>
                                <input type="date" name="dataFunc" value="<?= $data ?>">
                                <p>Endereco:</p>
                                <input type="text" name="endereFunc" value="<?= $endereco ?>">
                                <p>Telefone:</p>
                                <input type="text" name="telefFunc" value="<?= $telefone ?> " onkeyup="handlePhone(event)">
                                <p>Nivel:</p>
                                <input type="text" name="nivelFunc" value="<?= $nivel ?>">
                            </div>
                            <div id="botao"><input type="submit" value="Salvar Alteraração" id="btn-alterar"></div>
                        </form>
                    </div>

                <?php

                }
            } else {
                echo '<div class="erro">Sem resultado!</div>';
            }
            $mysqli->close();
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