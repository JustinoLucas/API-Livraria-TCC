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
    <link rel="stylesheet" href="/css/estoque.css">
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
    <div class="estoque-livro">
        <h1 id="titulo">Funcionarios Registrados</h1>
        <div>
            <table class="tabela-estoque">
                <tr class="tabela-head">
                    <th>ID</th>
                    <th style="min-width: 200px;">Nome</th>
                    <th>Função</th>
                    <th>Data de Nascimento</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Nivel</th>
                </tr>
                <?php

                require_once '../../config/conexao.php';

                $sql = "SELECT * FROM `usuarios` ORDER BY id ASC;";
                $sql_query = $mysqli->query($sql);
                while ($lista = $sql_query->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $lista['id']; ?></td>
                        <td><?php echo $lista['nome_usuario']; ?></td>
                        <td><?php echo $lista['funcao_usuario']; ?></td>
                        <td><?php echo $lista['data_usuario']; ?></td>
                        <td><?php echo $lista['endereco_usuario']; ?></td>
                        <td><?php echo $lista['telefone_usuario']; ?></td>
                        <td><?php echo $lista['nivel']; ?></td>

                    </tr>
                <?php
                }
                $mysqli->close();
                ?>
            </table>
        </div>
    </div>
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>
</body>

</html>