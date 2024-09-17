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
    <link rel="stylesheet" href="/css/alterando.css">
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

        if (empty($_POST["idLivro"])) {
            $id = $_SESSION['ID'];
            require_once '../config/conexao.php';

            $mysqli->set_charset("utf8");

            $sql = "SELECT * FROM `livros` WHERE id='$id';";

            $sql_query = $mysqli->query($sql);

            if ($sql_query->num_rows > 0) {
                while ($alterar = $sql_query->fetch_assoc()) {
                    $idLivro = $alterar["id"];
                    $nome = $alterar["nome_livro"];
                    $autor = $alterar["autor_livro"];
                    $categoria = $alterar["categoria_livro"];
                    $editora = $alterar["editora_livro"];
                    $data = $alterar["ano_livro"];
                    $sinopse = $alterar["sinopse_livro"];
                    $img = $alterar["img_livro"];
                }
            }
            $mysqli->close();
        }
        ?>
        <div class="livro-altera">
            <div><img class="capa-livro" src="<?php echo $img; ?>" alt=""></div>
            <form action="alterado.php" method="POST">
                <div class="livro-info">
                    <p>ID:</p>
                    <input type="text" name="idLivro" value="<?= $idLivro ?>" disabled>
                    <p>Nome do Livro:</p>
                    <input type="text" name="nomeLivro" value="<?= $nome ?>">
                    <p>Autor</p>
                    <input type="text" name="nomeAutor" value="<?= $autor ?>">
                    <p>Categoria</p>
                    <input type="text" name="categoriaLivro" value="<?= $categoria ?>">
                    <p>Editoria</p>
                    <input type="text" name="editoraLivro" value="<?= $editora ?>">
                    <p>Ano de Publicação:</p>
                    <input type="date" name="dataLivro" value="<?= $data ?>">
                    <p>Sinopse:</p>
                    <input type="text" name="sinopseLivro" value="<?= $sinopse ?>">
                    <p>Alterar URL de Imagem:</p>
                    <input type="text" name="imgLivro" value="<?= $img ?>">
                </div>
                <div><input type="submit" value="Salvar Alteraração" id="btn-salvar"></div>
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