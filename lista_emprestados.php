<?php
include_once('include/header.php');

use Dompdf\Css\Style;

include_once('conexao.php');


$quantidade = 10;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


$sql = "SELECT * FROM emprestimo WHERE nome_livro IS NOT NULL 
OR nome_livro2 IS NOT NULL 
OR nome_livro3 IS NOT NULL
OR cod_spn IS NOT NULL 
OR cod_spn2 IS NOT NULL 
OR cod_spn3 IS NOT NULL AND status=1 OR status=2 ORDER BY data_e DESC LIMIT $inicio,$quantidade";
$resp_sql = mysqli_query($_SESSION['conexao'], $sql);


echo '<br><center><h4 class="welcome-text" style="color: #a8b3ab;">Lista de<span class="text-primary fw-bold"> Livros Emprestados</span></h4></center><br>
<div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
<div class="card">
  <div class="card-body">
<div class="row">
<div class="col-lg-30">';

while ($linha = mysqli_fetch_array($resp_sql)) {
  $cod_spn = $linha['cod_spn'];
  $data = new DateTime($linha['data_f']);
  $dataAtual = new DateTime();


  if ($dataAtual == $data) {
    $teste = '<label class="badge badge-primary">Devolvido</label>';
  } elseif ($dataAtual < $data) {
    $teste = '<label class="badge badge-warning">Livro Emprestado</label>';
  } elseif ($dataAtual > $data) {

    $data_insert = date_format($data, "Y-m-d H:i:s");

    $teste = '<label class="badge badge-danger">Atrasado</label>';
    $sql_up1 = "UPDATE emprestimo SET status= 2 WHERE cod_spn=" . $cod_spn;

    $resp_sql1 = mysqli_query($_SESSION['conexao'], $sql_up1);
  }



  if ($linha['nome_livro']) {
    echo '<h6>' . $linha['nome_livro'] . '</h6>';
  }
  if ($linha['nome_livro2']) {
    echo '<h6>' . $linha['nome_livro2'] . '</h6>';
  }
  if ($linha['nome_livro3']) {
    echo '<h6>' . $linha['nome_livro3'] . '</h6>';
  }

  echo '
     <br><b>RA do Aluno:</b> ' . $linha['num_id'] . '
     <br><b>Aluno:</b> ' . $linha['nome_aluno'] . '
     <br><b>Empréstimo:</b> ' . date('d-m-Y', strtotime($linha['data_e'])) . '
     <br><b>Devolução:</b> ' . date('d-m-Y', strtotime($linha['data_f'])) . '';

  if ($linha['cod_spn']) {
    echo '<br><b style>SPN do Livro 1:</b> ' . $linha['cod_spn'] . '';
  }
  if ($linha['cod_spn2']) {
    echo '<br><b>SPN do Livro 2:</b> ' . $linha['cod_spn2'] . '';
  }
  if ($linha['cod_spn3']) {
    echo '<br><b>SPN do Livro 3:</b> ' . $linha['cod_spn3'] . '';
  }
  echo '<br><br><b ' . $linha['status'] . '>Status:</b>' . $teste . '</p>';

  if ($linha['cod_spn'] AND $linha['cod_spn2'] AND $linha['cod_spn3']) {
    echo '<p class="template-demo">
    <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '">Editar</a></button>
    <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '&cod_spn=' . $linha['cod_spn'] . '&cod_spn2=' . $linha['cod_spn2'] . '&cod_spn3=' . $linha['cod_spn3'] . '">Devolução/Gerar PDF</a></button>
      </p>';
  }elseif ($linha['cod_spn'] AND $linha['cod_spn2']) {
    echo '<p class="template-demo">
    <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '">Editar</a></button>
    <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '&cod_spn=' . $linha['cod_spn'] . '&cod_spn2=' . $linha['cod_spn2'].'">Devolução/Gerar PDF</a></button>
      </p>';
  }else {
    echo '<p class="template-demo">
    <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '">Editar</a></button>
    <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_emprestimo.php?id_opcao=' . $linha['id_opcao'] . '&cod_spn=' . $linha['cod_spn'] .'">Devolução/Gerar PDF</a></button>
      </p>';
  }
  echo '<hr>';
}

echo '</div>
</div>
</div>';



$sql_total = "SELECT id_opcao FROM emprestimo";
$resp_total = mysqli_query($_SESSION['conexao'], $sql_total);
$num_total = mysqli_num_rows($resp_total);
$pagina_total = ceil($num_total / $quantidade);
$exibir = 3;
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina + 1) >= $pagina_total) ? $pagina_total : $pagina + 1;


?>
<br><br>

</div>
</div>
</div>
</div>

<center>
  <?php

  echo '<br><nav id="pag"><ul class="pagination">
 <li class="page-item"><a class="page-link" href ="?pagina=1">Primeira</a></li>';
  echo '<li class="page-item"><a aria-label="Previous" class="page-link" href ="?pagina=' . $anterior . '"><</a></li>';


  for ($i = $pagina - $exibir; $i <= $pagina - 1; $i++) {
    if ($i > 0)
      echo '<li class="page-item"><a class="page-link" href ="?pagina=' . $i . '">' . $i . '</a></li>';
  }

  echo '<li class="page-item"><a class="active page-link" href="?pagina=' . $pagina . '"><b>' . $pagina . '</b></a></li>';

  for ($i = $pagina + 1; $i < $pagina + $exibir; $i++) {
    if ($i <= $pagina_total)
      echo '<li class="page-item"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
  }
  echo '<li class="page-item"><a aria-label="Next" class="page-link" href="?pagina=' . $posterior . '">></a></li>';
  echo '<li class="page-item"><a class="page-link" href="?pagina=' . $pagina_total . '">Ultima</a></li></ul></nav>';
  // executa a consulta SQL


  ?>


</center>



<style>
  #pag {
    display: inline-block;
  }

  .pagination a {
    color: black;
    float: left;
    padding: 8px 16px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 4px;
    border-radius: 5px;
  }

  #link {
    text-decoration: none;
    color: white;
  }

  #link:hover {
    color: white;
  }


  .pagination a.active {
    background-color: #035afc;
    color: white;

  }

  .pagination a:hover:not(.active) {
    background-color: #ddd;
  }
</style>


<?php

include_once 'include/footer.php';

?>