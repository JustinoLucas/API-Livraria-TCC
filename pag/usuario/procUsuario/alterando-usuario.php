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
    <?php

    if (isset($_POST["nomeFunc"]) && isset($_POST["loginFunc"]) && isset($_POST["funcaoFunc"])  && isset($_POST["dataFunc"]) && isset($_POST["nivelFunc"]) && isset($_POST["endereFunc"]) && isset($_POST["telefFunc"]) != '') {

        $id = $_SESSION['idFunc'];
        $nome = $_POST["nomeFunc"];
        $login = $_POST["loginFunc"];
        $funcao = $_POST["funcaoFunc"];
        $data = $_POST["dataFunc"];
        $nivel = $_POST["nivelFunc"];
        $endereco = $_POST["endereFunc"];
        $telefone = $_POST["telefFunc"];

        require_once '../../../config/conexao.php';

        $mysqli->set_charset("utf8");

        $sql = "UPDATE `usuarios` SET id = $id, nome_usuario = '$nome', login_usuario = '$login', funcao_usuario = '$funcao', data_usuario = '$data', nivel = '$nivel', endereco_usuario = '$endereco', telefone_usuario = '$telefone' WHERE id='$id'; ";

        if ($mysqli->query($sql) === TRUE) {
            echo  '<div class="sucesso">Dados atualizados com sucesso!</div>';
        } else {
            $erro = "Erro :" . $sql . "<br>" . $mysqli->error;
        }
        $mysqli->close();
    } else {
        echo '<div class="erro">Campo obrigatório não preenchido</div>';
    }

    ?>
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>
</body>

</html>