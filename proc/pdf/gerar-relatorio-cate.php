<?php
session_start();

require_once '/wamp64/www/projeto_tcc/lib/vendor/autoload.php';
require_once '/wamp64/www/projeto_tcc/config/conexao.php';

$_SESSION['categoria'];
$categoria = $_SESSION['categoria'];

$sql = "SELECT movimento.*, livros.categoria_livro FROM `movimento` INNER JOIN `livros` ON movimento.id_livro = livros.id WHERE livros.categoria_livro = '$categoria'  ORDER BY livros.id ASC;";
$sql_query = $mysqli->query($sql);

$date = new DateTime();
$formatter = new IntlDateFormatter(
    'pt_BR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'America/Sao_Paulo',
    IntlDateFormatter::GREGORIAN
);

$dados = "<!DOCTYPE html>";
$dados .= "<html lang='pt-br'>";
$dados .= "<head>";
$dados .= "<meta charset='UTF-8'>";
$dados .= "<link rel='stylesheet' href='http://localhost/projeto_tcc/css/pdf.css'>";
$dados .= "</head>";
$dados .= "<body>";
$dados .= '<h1>Relátorio de Categoria: ' . $categoria . '</h1>';
if ($sql_query->num_rows > 0) {
    $dados .=    '<table>';
    $dados .=    '<tr class="tabela-head">';
    $dados .=    '<th>ID</th>';
    $dados .=    '<th>ID Livro</th>';
    $dados .=    '<th>Categoria</th>';
    $dados .=    '<th style="min-width: 50px;">Quantidade Atual</th>';
    $dados .=    '<th>Quantidade Movimento</th>';
    $dados .=    '<th>Tipo Movimento</th>';
    $dados .=    '<th>Data Movimento</th>';
    $dados .=    '</tr>';
    while ($lista = $sql_query->fetch_assoc()) {
        $dados .= '<tr>';
        $dados .= '<td>' . $lista['id'] . '</td>';
        $dados .= '<td>' . $lista['id_livro'] . '</td>';
        $dados .= '<td>' . $lista['categoria_livro'] . '</td>';
        $dados .= '<td>' . $lista['quantidade_atual'] . '</td>';
        $dados .= '<td>' . $lista['quantidade_movimento'] . '</td>';
        $dados .= '<td>' . $lista['tipo_movimento'] . '</td>';
        $dados .= '<td>' . date("d/m/Y", strtotime($lista['data_movimento'])) . '</td>';
        $dados .= '<tr>';
    }
    $dados .= '</table>';
    $dados .= 'São José dos Pinhais, ' . $formatter->format($date);
}
$dados .= "</body>";
$dados .= "</html>";

use Dompdf\Dompdf;

$dompdf = new Dompdf(['enable_remote' => true]);
$dompdf->loadHtml($dados);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();
