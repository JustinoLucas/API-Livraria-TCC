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

    <?php

    require_once '../config/conexao.php';

    if(($_POST["nomeLivro"]) && ($_POST["nomeAutor"]) && ($_POST["categoriaLivro"]) && ($_POST["editoraLivro"])  && ($_POST["sinopseLivro"]) && ($_POST["imgLivro"]) != '') {
        
        $nome = $_POST["nomeLivro"];
        $autor = $_POST["nomeAutor"];
        $categoria = $_POST["categoriaLivro"];
        $editora = $_POST["editoraLivro"];
        $data = $_POST["dataLivro"];
        $sinopse = $_POST["sinopseLivro"];
        $img = $_POST["imgLivro"];

        $stmt =  $mysqli->prepare("INSERT INTO `livros`(`nome_livro`,`autor_livro`,`categoria_livro`,`editora_livro`,`ano_livro`,`sinopse_livro`, `img_livro`) VALUES(?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssss', $nome, $autor, $categoria, $editora, $data, $sinopse, $img);
        
        $sql = "SELECT nome_livro FROM livros WHERE nome_livro = '$nome'";
        $sql_query = $mysqli->query($sql);
        $pesquisa = $sql_query->fetch_assoc();

        $duplicado = $pesquisa['nome_livro'];

        if ($duplicado != $nome) {
            if (!$stmt->execute()) {
                $erro = $stmt->error;
            } else {
                echo  '<div class="sucesso">Dados cadastrados com sucesso!</div>';
            }
        } else {
            echo '<div class="erro">Livro ja cadastrado!</div>';
        }
    } else {
        echo '<div class="erro">Campo obrigatorio nao preenchido!</div>';
    }
    ?>
    <!-- <div class="btn-voltar-cadastro">
        <a href="">Voltar a Cadastrar</a>
    </div> -->
    <footer>
        <div>
            Lucas Justino Turatto ©
        </div>
    </footer>
</body>

</html>