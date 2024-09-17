<?php

include('../../config/protecao.php');

error_reporting(0);

$editora = $_POST["editora"];

$_SESSION['editora'] = $editora;

$disableBtn = 'hidden';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estoque de Livros</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/relatorio.css">
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
            <a href="../estoque.php">Estoque</a>
            <a href="../pesquisar-livro.php">Pesquisar</a>
            <a href="../cadastrar-livro.php">Cadastrar</a>
            <a href="../movimento.php">Entrada & Saida</a>
            <a href="../relatorio.php">Relatorio</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
        </div>
        <div>
            <a href="/sair.php" id="btn-sair">Sair</a>
        </div>
    </div>

    <?php

    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    ?>
    <div>
        <h1>Relátorio de Editora</h1>
    </div>
    <div class="pesquisa">
        <form method="POST">
            <?php
            $categoria = "";
            if (isset($dados['categoria'])) {
                $categoria = $dados['gategoria'];
            }
            ?>
            <label>Nome da Editora</label>
            <input type="text" name="editora" value="<?php echo $categoria; ?>">

            <input type="submit" value="Pesquisar" name="pesqLivros" id="btn-pesquisar">
        </form>

        <?php
        if (!empty($dados['pesqLivros'])) {
            $editora = $dados['editora'];
            $disableBtn = '';
            require_once '../../config/conexao.php';

            $sql = "SELECT movimento.*, livros.editora_livro FROM `movimento` INNER JOIN `livros` ON movimento.id_livro = livros.id WHERE livros.editora_livro = '$editora'  ORDER BY livros.id ASC;";
            $sql_query = $mysqli->query($sql);

            if ($sql_query->num_rows > 0) {
        ?>
                <div class="pesquisa3">
                    <table>
                        <tr class="tabela-head">
                            <th>ID</th>
                            <th>ID Livro</th>
                            <th>Editora</th>
                            <th style="min-width: 50px;">Quantidade Atual</th>
                            <th>Quantidade Movimento</th>
                            <th>Tipo Movimento</th>
                            <th>Data Movimento</th>
                            <th>Horario Movimento</th>
                        </tr> <?php
                                while ($lista = $sql_query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $lista['id']; ?></td>
                                <td><?php echo $lista['id_livro']; ?></td>
                                <td id="edito"><?php echo $lista['editora_livro']; ?></td>
                                <td><?php echo $lista['quantidade_atual']; ?></td>
                                <td><?php echo $lista['quantidade_movimento']; ?></td>
                                <td><?php echo $lista['tipo_movimento']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($lista['data_movimento'])); ?></td>
                                <td><?php echo $lista['horario_movimento']; ?></td>
                            </tr>

                    <?php
                                }
                            } else {
                                $disableBtn = 'hidden';
                                echo '<div class="pesquisa3">Nenhum movimento de estoque encontrado com essa Editora.</div>';
                            }
                    ?>
                <?php
            }


                ?>
                    </table>
                    <form method="POST" action="/proc/pdf/gerar-relatorio-edito.php" class="tabela-tipo-relatorio">
                        <input type="submit" value="Gerar Relatorio em PDF" id="btn-pesquisar" <?php echo $disableBtn; ?>>
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