<?php

include_once('conexao.php');
include_once('include/header.php');

if (isset($_POST['texto'])) {

  $texto = mysqli_real_escape_string($_SESSION['conexao'], $_POST['texto']);

  $sqli_total = "SELECT id_tex FROM relatorio_texto WHERE texto = '$texto'";
  $respi_total = mysqli_query($_SESSION['conexao'], $sqli_total);
  $nume_total = mysqli_num_rows($respi_total);

  if ($nume_total > 0) {

    echo '<center><label style="font-size:medium;" class="badge badge-warning">Dados iguais não podem ser inseridos</label></center>';
  } else {
    $sql_in = "INSERT INTO relatorio_texto (texto,data_r) VALUES ('$texto',NOW())";
    $resp_sql_in = mysqli_query($_SESSION['conexao'], $sql_in);

    if ($resp_sql_in) {
      echo '<center><label style="font-size:medium;" class="badge badge-success">Relatório inserido com sucesso</label></center>';
    } else {
      echo '<center><label style="font-size:medium;" class="badge badge-warning">Erro ao inserir</label></center>';
    }
  }
}

?>

<br><br><br>
<h3 class="welcome-text" style="color: #a8b3ab;text-align:center;">Relatório <span class="text-primary fw-bold"> Semanal</span></h3>
<div class="col-10 grid-margin stretch-card mx-auto">
  <div class="card">
    <div class="card-body"><br><br>
      <form class="forms-sample" action="relatorioSemanal.php" method="post">
        <textarea name="texto" id="" class="col-9" cols="80" rows="15" placeholder="Escreva aqui seu relatório..." maxlength="100000000" ></textarea><br><br>
        <center><button type="submit" class="btn btn-primary me-5" value="Enviar" style="position:relative;left:5%;">Enviar</button></center>
      </form>
    </div>
  </div>
</div>



<?php
$quantidade = 4;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


$sql = "SELECT * FROM relatorio_texto ORDER BY data_r DESC LIMIT $inicio,$quantidade";
$resp_sql = mysqli_query($_SESSION['conexao'], $sql);
$dados = mysqli_num_rows($resp_sql);


echo '<br><div class="col-10 grid-margin mx-auto">
<div class="card">
  <div class="card-body">';
if ($dados > 0){
  while ($linha = mysqli_fetch_array($resp_sql)) {
    echo '' . $linha['texto'] .'<br><br>
    <b style="display:none;">'.$linha['id_tex'].'</b>
    <b>Data e Hora:</b> ' . date('d-m-Y H:m:s', strtotime($linha['data_r'])) .'<br>

    <p class="template-demo">
    <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_tex.php?id_tex=' . $linha['id_tex'] . '">Editar</a></button>
    <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_tex.php?id_tex=' . $linha['id_tex'] . '">Deletar</a></button>
    </p><hr>';
    
  }

}else{
  echo '<center><p class="text-danger">Nenhum relatório postado</p></center>';
}

echo '</div></div></div>';


$sql_total = "SELECT id_tex FROM relatorio_texto";
$resp_total = mysqli_query($_SESSION['conexao'], $sql_total);
$num_total = mysqli_num_rows($resp_total);
$pagina_total = ceil($num_total / $quantidade);
$exibir = 3;
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina + 1) >= $pagina_total) ? $pagina_total : $pagina + 1;

?>

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

  textarea {
    border: 1px solid blue;
    border-radius: 10px;
    background-color: ghostwhite;
    position: relative;
    left: 13%;
  }
</style>


<?php

include_once 'include/footer.php';

?>