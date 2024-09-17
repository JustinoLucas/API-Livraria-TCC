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
    <link rel="stylesheet" href="/css/estoque.css">
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
                <a href="#">Estoque</a>
                <a href="pesquisar-livro.php">Pesquisar</a>
                <a href="cadastrar-livro.php">Cadastrar</a>
                <a href="movimento.php">Entrada & Saida</a>
                <a href="relatorio.php">Relatorio</a>
                <a href="../pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
            </div>
            <div>
                <a href="/sair.php" id="btn-sair">Sair</a>
            </div>
        </div>
        <div class="estoque-livro">
            <h1 id="titulo">Livros no Estoque</h1>
            <div>
                <table class="tabela-estoque">
                    <tr class="tabela-head">
                        <th>ID</th>
                        <th>Capa</th>
                        <th style="min-width: 200px;">Nome</th>
                        <th>Autor</th>
                        <th>Categoria</th>
                        <th>Editora</th>
                        <th>Estoque</th>
                    </tr>
                    <?php

                    require_once '../config/conexao.php';

                    $sql = "SELECT * FROM `livros` ORDER BY id ASC;";
                    $sql_query = $mysqli->query($sql);
                    while ($lista = $sql_query->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $lista['id']; ?></td>
                            <td><img class="imagem-estoque" src="<?php echo $lista['img_livro']; ?>" alt=""></td>
                            <td><?php echo $lista['nome_livro']; ?></td>
                            <td><?php echo $lista['autor_livro']; ?></td>
                            <td><?php echo $lista['categoria_livro']; ?></td>
                            <td><?php echo $lista['editora_livro']; ?></td>
                            <td><?php echo $lista['quantidade_estoque']; ?></td>
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
    </div>
</body>

</html>