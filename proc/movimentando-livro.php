<?php

include('../config/protecao.php');
date_default_timezone_set('America/Sao_Paulo');

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/movimento.css">
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
    <div class="movimento">
        <?php

        if (empty($_POST["idLivro"])) {
            echo '<div class="erro"">Por favor preencher o campo do ID!</div>';
        } else {
            require_once '../config/conexao.php';

            $id = $_POST["idLivro"];
            $tipo = $_POST["tipoMovi"];
            $quantidade = $_POST["quantidadeLivro"];
            $data = $_POST["dataHoje"];
            $hora = $_POST["horaHoje"];

            $sql = "SELECT * FROM livros WHERE id = '$id' ORDER BY id DESC LIMIT 1";
            $sql_query = $mysqli->query($sql);

            if ($sql_query->num_rows > 0) {
                while ($pesquisa = $sql_query->fetch_assoc()) {
                    $quantidade_atual = $pesquisa['quantidade_estoque'];
                    $nome = $pesquisa['nome_livro'];
                    
                    if ($tipo === 'Entrada') {
                        $quantidade_nova = $quantidade + $quantidade_atual;

                        $sql = "UPDATE livros SET quantidade_estoque = '$quantidade_nova' WHERE id='$id' ORDER BY id DESC LIMIT 1";

                        $stmt =  $mysqli->prepare("INSERT INTO `movimento`(`id_livro`,`quantidade_atual`,`quantidade_movimento`,`data_movimento`,`horario_movimento`,`tipo_movimento`) VALUES(?,?,?,?,?,?)");
                        $stmt->bind_param('ssssss', $id, $quantidade_nova, $quantidade, $data, $hora, $tipo);

                        if ($mysqli->query($sql) === TRUE) {
                            if ($stmt->execute() ===  TRUE) {                           
                                echo  '<div class="entrada">Quantidade de ' . $quantidade . ' livros foram adicionados ao estoque de '. $nome .'.</div>';
                            }
                        } else {
                            $erro = "Erro :" . $sql . "<br>" . $mysqli->error;
                        }
                    } elseif ($tipo === 'Saida') {
                        $quantidade_nova = $quantidade_atual - $quantidade;

                        $sql = "UPDATE livros SET quantidade_estoque = '$quantidade_nova' WHERE id='$id' ORDER BY id DESC LIMIT 1";

                        $stmt =  $mysqli->prepare("INSERT INTO `movimento`(`id_livro`,`quantidade_atual`,`quantidade_movimento`,`data_movimento`,`horario_movimento`,`tipo_movimento`) VALUES(?,?,?,?,?,?)");
                        $stmt->bind_param('ssssss', $id, $quantidade_nova, $quantidade, $data, $hora, $tipo);
                        if ($mysqli->query($sql) === TRUE) {
                            if ($stmt->execute() ===  TRUE) {
                                echo  '<div class="saida">Quantidade de ' . $quantidade . ' livros foram removidos do estoque de '. $nome .'.</div>';
                            }
                        } else {
                            $erro = "Erro :" . $sql . "<br>" . $mysqli->error;
                        }
                    } else{
                        echo '<div class="erro">Selecione um tipo de movimento!</div>';
                    }
                }
            } else {
                echo '<div class="erro">Nenhum Livro foi encotrado com este ID!</div>';
            }
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