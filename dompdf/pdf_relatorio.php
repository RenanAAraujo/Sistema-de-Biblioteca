<?php

include_once('conexao.php');
//carregar o compose
require './vendor/autoload.php';

use Dompdf\Dompdf;



$sql = "SELECT * FROM relatorio";
$resp_query = mysqli_query($_SESSION['conexao'], $sql);

// $sql1 = "SELECT * FROM relatorio_cad_livro";
// $resp_query_livro = mysqli_query($_SESSION['conexao'], $sql1);


//Vai pegar os dados e coloca nas variaveis
while ($row = mysqli_fetch_assoc($resp_query)) {
    $emprestimo = $row['emprestimo'];
    $id_opcao = $row['id_opcao'];
    $nome_aluno = $row['nome_aluno'];
    $num_id = $row['num_id'];
    $nome_livro = $row['nome_livro'];
    $nome_livro2 = $row['nome_livro2'];
    $nome_livro3 = $row['nome_livro3'];
    $cod_spn = $row['cod_spn'];
    $cod_spn2 = $row['cod_spn2'];
    $cod_spn3 = $row['cod_spn3'];
    $data_e =  date('d-m-Y', strtotime($row['data_e']));
    $data_f = date('d-m-Y', strtotime($row['data_f']));

}

// while ($linha = mysqli_fetch_assoc($resp_query_livro)) {
//     $cad_livro = $linha['cad_livro'];
//     $nome_livro = $linha['nome_livro'];
//     $emissao = $linha['emissao'];
//     $cod_barra = $linha['cod_barra'];
//     $cod_spn = $linha['cod_spn'];
//     $editora = $linha['editora'];
//     $categoria = $linha['categoria'];
//     $data_cad =  date('d-m-Y', strtotime($linha['data_cad']));
// }


$html = '<head>
<meta charset="UTF-8">
<title>Comprovante</title>
</head>';

$html .= '
<h3>' . $emprestimo . '</h3>
<strong>Nome do Aluno:</strong> ' .$nome_aluno . '
<strong>RA do Aluno:</strong> ' .$num_id . '
<strong>E-mail:</strong> ' . $email . '
<strong>Livro 1:</strong> ' . $nome_livro . '
<strong>Livro 2:</strong> ' . $nome_livro2 . '
<strong>Livro 3:</strong> ' . $nome_livro3 . '
<strong>SPN do Livro 1:</strong> ' . $cod_spn . '
<strong>SPN do Livro 2:</strong> ' . $cod_spn2 . '
<strong>SPN do Livro 3:</strong> ' . $cod_spn3 . '
<strong>Empréstimo:</strong> ' . $data_e . '
<strong>Devolução:</strong> ' . $data_f . '
 ';



// Agora você pode usar o HTML gerado para gerar o PDF:
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
$dompdf->stream('Emprestimo', array('Attachment' => 1));
$dompdf->output();

?>

