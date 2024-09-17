<?php

include('../../config/protecao.php');

$data_inicio = $_POST["data_inicio"];
$data_final = $_POST["data_final"];

$_SESSION['data_inicio'] = $data_inicio;
$_SESSION['data_final'] = $data_final;

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
        <h1>Relátorios entre Datas</h1>
    </div>
    <div class="pesquisa">
        <form method="POST">
            <?php
            $data_inicio = "";
            if (isset($dados['data_inicio'])) {
                $data_inicio = $dados['data_inicio'];
            }
            ?>
            <label>Data de Inicio</label>
            <input type="date" name="data_inicio" value="<?php echo $dados_inicio; ?>">
            <?php
            $dados_final = "";
            if (isset($dados['data_final'])) {
                $data_final = $dados['data_final'];
            }
            ?>
            <label> - Data Final</label>
            <input type="date" name="data_final" value="<?php echo $dados_final; ?>">

            <input type="submit" value="Pesquisar" name="pesqLivros" id="btn-pesquisar">
        </form>

        <?php
        if (!empty($dados['pesqLivros'])) {
            $data_inicio = $dados['data_inicio'];
            $data_final = $dados['data_final'];

            require_once '../../config/conexao.php';

            $sql = "SELECT * FROM `movimento` WHERE data_movimento  BETWEEN '$data_inicio' AND '$data_final' ORDER BY id ASC;";

            $sql_query = $mysqli->query($sql);
            if ($sql_query->num_rows > 0) {
        ?>
                <div class="pesquisa3">
                    <table>
                        <tr class="tabela-head">
                            <th>ID</th>
                            <th>ID Livro</th>
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
                                <td><?php echo $lista['quantidade_atual']; ?></td>
                                <td><?php echo $lista['quantidade_movimento']; ?></td>
                                <td><?php echo $lista['tipo_movimento']; ?></td>
                                <td><?php echo date("d/m/Y", strtotime($lista['data_movimento'])); ?></td>
                                <td><?php echo $lista['horario_movimento']; ?></td>
                            </tr>

                    <?php
                                }
                            } else {
                                echo '<div class="pesquisa3">Nenhum movimento encontrado entre as datas.</div>';
                            }
                    ?>
                    </table>
                    <form method="POST" action="/proc/pdf/gerar-relatorio-data.php" class="tabela-tipo-relatorio">
                        <input type="submit" value="Gerar Relatorio em PDF" id="btn-pesquisar">
                    </form>
                </div>

            <?php
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