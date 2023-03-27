<?php
include_once('conexao.php');
include_once('include/header.php');
// echo '<button class="btn btn-primary me-2"><a href="dompdf/pdf_relatorio.php">PDF</a></button>';
$quantidade = 2;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


$sql = "SELECT * FROM relatorio WHERE nome_livro IS NOT NULL 
OR nome_livro2 IS NOT NULL 
OR nome_livro3 IS NOT NULL
OR cod_spn IS NOT NULL 
OR cod_spn2 IS NOT NULL 
OR cod_spn3 IS NOT NULL ORDER BY nome_aluno ASC LIMIT $inicio,$quantidade";
$resp_query = mysqli_query($_SESSION['conexao'], $sql);

$sql = "SELECT * FROM relatorio_cad_livro";
$resp_query_livro = mysqli_query($_SESSION['conexao'], $sql);

echo '<br><center><h4 class="welcome-text" style="color: #a8b3ab;">Relatório<span class="text-primary fw-bold"> Diário</span></h4></center><br> 
<div class="col-lg-10 grid-margin stretch-card" style="margin: 0 auto;">
  <div class="card">
    <div class="card-body">
    <div class="row">
    <div class="col-lg-12">';

while ($linha = mysqli_fetch_array($resp_query)) {

  if ($linha['status'] == 1 || $linha['status'] == 0) {

    $data = new DateTime($linha['data_f']);
    $dataAtual = new DateTime();


    if ($linha['status'] == 0) {

      $teste = '<label class="badge badge-success">Devolvido</label>';
    } elseif ($linha['status'] == 1) {

      $teste = '<label class="badge badge-warning">Emprestado</label>';
    }

    $emprestimo = $linha['emprestimo'];
    $id_opcao = $linha['id_opcao'];
    $nome_aluno = $linha['nome_aluno'];
    $num_id = $linha['num_id'];
    $nome_livro = $linha['nome_livro'];
    $nome_livro2 = $linha['nome_livro2'];
    $nome_livro3 = $linha['nome_livro3'];
    $cod_spn = $linha['cod_spn'];
    $cod_spn2 = $linha['cod_spn2'];
    $cod_spn3 = $linha['cod_spn3'];
    $data_e =  date('d-m-Y', strtotime($linha['data_e']));
    $data_f = date('d-m-Y', strtotime($linha['data_f']));


    echo '<h3>' . $emprestimo . '</h3>
    <br><b>Nome do Aluno:</b> ' . $nome_aluno . '
    <br><b>RA do Aluno:</b> ' . $num_id . '
    <br><b>E-mail:</b> ' . $email . '';

    if ($linha['nome_livro']) {
      echo '<br><b> Livro 1: </b>' . $linha['nome_livro'] . '';
    }
    if ($linha['nome_livro2']) {
      echo '<br><b>Livro 2: </b>' . $linha['nome_livro2'] . '';
    }
    if ($linha['nome_livro3']) {
      echo '<br><b>Livro 3: </b>' . $linha['nome_livro3'] . '';
    }
    
    
    if ($linha['cod_spn']) {
      echo '<br><b style>SPN do Livro 1:</b> ' . $linha['cod_spn'] . '';
    }
    if ($linha['cod_spn2']) {
      echo '<br><b>SPN do Livro 2:</b> ' . $linha['cod_spn2'] . '';
    }
    if ($linha['cod_spn3']) {
      echo '<br><b>SPN do Livro 3:</b> ' . $linha['cod_spn3'] . '';
    }

    echo '<br><b>Empréstimo:</b> ' . $data_e . '
    <br><b>Devolução:</b> ' . $data_f . ' <br></p>
    <hr>';
  }
}

while ($linha = mysqli_fetch_assoc($resp_query_livro)) {

  $cad_livro = $linha['cad_livro'];
  $nome_livro = $linha['nome_livro'];
  $emissao = $linha['emissao'];
  $cod_barra = $linha['cod_barra'];
  $cod_spn = $linha['cod_spn'];
  $editora = $linha['editora'];
  $categoria = $linha['categoria'];
  $data_cad =  date('d-m-Y', strtotime($linha['data_cad']));

  echo '<h3>' . $cad_livro . '</h3>
  <br><b>Nome do Livro:</b> ' . $nome_livro . '
  <br><b>Data de emissão:</b> ' . $emissao . '
    <br><b>Código de barra:</b> ' . $cod_barra . '
    <br><b>Código ISBN:</b> ' . $cod_spn . '
    <br><b>Editora :</b> ' . $editora . '
    <br><b>Categoria:</b> ' . $categoria . '
    <br><b>Data de cadastro:</b> ' . $data_cad . '
    </p>
    <hr>
        ';
}

echo '
</div>
</div>
</div>
</div>
</div>';


$sql_total = "SELECT id_opcao FROM relatorio";
$resp_total = mysqli_query($_SESSION['conexao'], $sql_total);
$num_total = mysqli_num_rows($resp_total);
$pagina_total = ceil($num_total / $quantidade);
$exibir = 3;
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina + 1) >= $pagina_total) ? $pagina_total : $pagina + 1;

?>
<br><br>
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