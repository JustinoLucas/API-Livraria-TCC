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
    <div class="pesquisando-livro-exc">
        <h1></h1>

        <?php

        if (empty($_SESSION['idFunc'])) {
            echo "Por favor preencher o campo do Nome";
        } else {
            $id = $_SESSION['idFunc'];

            require_once '../../../config/conexao.php';

            $sql = "SELECT * FROM usuarios WHERE id LIKE '%$id%'";
            $sql_query = $mysqli->query($sql);
            $mysqli->close();
            while ($pesquisa = $sql_query->fetch_assoc()) { ?>
                <div class="fundo">
                    <div class="livro-info">
                        <h2><?php echo $pesquisa['nome_usuario']; ?></h2>
                        <p>ID</p>
                        <hr><?php echo $pesquisa['id']; ?>
                        <p>Função</p>
                        <hr><?php echo $pesquisa['funcao_usuario']; ?>
                        <p>Login</p>
                        <hr><?php echo $pesquisa['login_usuario']; ?>
                        <p>Data de Aniversário</p>
                        <hr><?php echo date("d / m / Y", strtotime($pesquisa['data_usuario'])); ?>
                        <p>Endereço</p>
                        <hr><?php echo $pesquisa['endereco_usuario']; ?>
                        <p>Telefone</p>
                        <hr><?php echo $pesquisa['telefone_usuario']; ?>
                        <p>Nivel</p>
                        <hr><?php echo $pesquisa['nivel']; ?>
                    </div>
                </div>
        <?php

            }
        }
        ?>
    
    <P id="deseja-p">Deseja realmente Excluir este Funcionario?</P>
    <div class="btn-menu-exclui">

        <form action="excluindo-usuario.php" method="POST">
            <input id="btn-excluir" type="submit" value="Excluir Funcionario" >
        </form>

    </div></div>
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>
</body>

</html>