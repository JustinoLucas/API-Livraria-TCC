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

    require_once '../../../config/conexao.php';

    if ($_POST["nomeFunc"] && $_POST["idadeFunc"] && $_POST["funcaoFunc"] && $_POST["endereFunc"] && $_POST["telefFunc"] && $_POST["loginFunc"] && $_POST["senhaFunc"] != '') {

        $nome = $_POST["nomeFunc"];
        $idade = $_POST["idadeFunc"];
        $funcao = $_POST["funcaoFunc"];
        $endereco = $_POST["endereFunc"];
        $telefone = $_POST["telefFunc"];
        $login = $_POST["loginFunc"];
        $senha = password_hash($_POST["senhaFunc"], PASSWORD_DEFAULT);

        $stmt =  $mysqli->prepare("INSERT INTO `usuarios`(`nome_usuario`,`login_usuario`,`senha_usuario`,`endereco_usuario`,`telefone_usuario`,`funcao_usuario`,`data_usuario`) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssss', $nome, $login, $senha, $endereco, $telefone, $funcao, $idade);

        $sql = "SELECT nome_usuario FROM usuarios WHERE nome_usuario = '$nome'";

        $sql_query = $mysqli->query($sql);
        $pesquisa = $sql_query->fetch_assoc();
        $duplicado = $pesquisa['nome_usuario'];

        if ($duplicado != $nome) {
            if (!$stmt->execute()) {
                $erro = $stmt->error;
            } else {
                echo  '<div class="sucesso">Dados de funcionario cadastrados com sucesso!</div>';
            }
        } else {
            echo '<div class="erro">Funcionario ja cadastrado!</div>';
        }
    } else {
        echo '<div class="erro">Campo obrigatorio nao preenchido!</div>';
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