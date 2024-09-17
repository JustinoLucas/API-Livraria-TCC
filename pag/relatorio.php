<?php
ob_start();
include('../config/protecao.php');

ob_end_flush();
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
            <a href="estoque.php">Estoque</a>
            <a href="pesquisar-livro.php">Pesquisar</a>
            <a href="cadastrar-livro.php">Cadastrar</a>
            <a href="movimento.php">Entrada & Saida</a>
            <a href="#">Relatorio</a>
            <a href="/pag/usuario/usuarios.php" id="btn-funcionario" <?php echo $btn_disabled; ?>>Gerenciar Funcionarios</a>
        </div>
        <div>
            <a href="/sair.php" id="btn-sair">Sair</a>
        </div>
    </div><?php
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            $invisivel = '';

            $selectOption = $dados['tipo-relatorio'];

            if ($selectOption == '1' || $selectOption == '2' || $selectOption == '4' || $selectOption == '5') {
                $invisivel = 'hidden';
                $divhidden = 'style="display:none; visibility:hidden;"';
            } else {
                $invisivel = '';
            }
            ?><div class="pesquisar-livro">
        <div>
            <h1>Relátorios</h1>
        </div><?php
                if ($dados['tipo-relatorio']) {
                    $selectOption = $dados['tipo-relatorio'];
                    switch ($selectOption) {
                        case '1':
                            header('Location: relatorios/relatorio-30.php');
                            break;
                        case '2':
                            header('Location: relatorios/relatorio-7.php');
                            break;
                        case '3':
                            header('Location: relatorios/relatorio-data.php');
                            break;
                        case '4':
                            header('Location: relatorios/relatorio-categoria.php');
                            break;
                        case '5':
                            header('Location: relatorios/relatorio-editora.php');
                            break;
                        default:
                            var_dump($dados['pesqUsuario']);
                            break;
                    }
                }
                ?><div class="pesquisa" <?php echo $divhidden; ?>>
            <form method="POST" action="" class="tabela-tipo-relatorio" <?php echo $invisivel; ?>>
                <div>
                    <p id="id-procura">Tipo de relatorio:</p>
                    <select name="tipo-relatorio" id="tipo">
                        <option></option>
                        <option value="1">Ultimos 30 Dias</option>
                        <option value="2">Ultimos 7 Dias</option>
                        <option value="3">Entre 2 Datas</option>
                        <option value="4">Categoria</option>
                        <option value="5">Editora</option>
                    </select>
                </div>
                <input type="submit" value="Gerar Relatorio" id="btn-pesquisar">
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