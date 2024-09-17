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
    <link rel="stylesheet" href="/css/procurado.css">
    
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

        <?php

        if (empty($_SESSION['ID'])) {
            echo "Por favor preencher o campo do Nome";
        } else {
            $id = $_SESSION['ID'];

            require_once '../config/conexao.php';

            $sql = "SELECT id,nome_livro,autor_livro,categoria_livro,editora_livro,ano_livro,sinopse_livro,img_livro FROM livros WHERE id LIKE '%$id%'";
            $sql_query = $mysqli->query($sql);
            $mysqli->close();
            while ($pesquisa = $sql_query->fetch_assoc()) { ?>
                <div class="livro2">
                    <div><img class="capa-livro" src="<?php echo $pesquisa['img_livro']; ?>" alt=""></div>
                    <div class="livro-info">
                        <h2><?php echo $pesquisa['nome_livro']; ?></h2>
                        <p>ID</p>
                        <hr><?php echo $pesquisa['id']; ?>
                        <p>Autor</p>
                        <hr><?php echo $pesquisa['autor_livro']; ?>
                        <p>Categoria</p>
                        <hr><?php echo $pesquisa['categoria_livro']; ?>
                        <p>Editoria</p>
                        <hr><?php echo $pesquisa['editora_livro']; ?>
                        <p>Ano de Publicação</p>
                        <hr><?php echo date("d / m / Y", strtotime($pesquisa['ano_livro'])); ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
    </div>
    <div class="btn-menu-exclui">
        <div class="x1">
            <P id="deseja-p">Deseja realmente Excluir este Livro?</P>
        </div>
        <div class="x2">
            <form action="apagando.php" method="POST">
                <input id="btn-excluir-sim" type="submit" value="Excluir Livro">
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