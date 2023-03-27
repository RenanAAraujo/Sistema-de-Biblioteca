<?php

include_once 'conexao.php';

include_once 'include/header.php';

$pagina = (isset($_GET['pagina'])) ? $_GET['pagina'] : 1;

if (!isset($_GET['pesquisar'])) {
  header("Location: home.php");
} else {
  $valor_pesquisar = $_GET['pesquisar'];


  //Selecionar todos os livros da tabela
  $livros = "SELECT * FROM cad_livro WHERE nome_livro LIKE '%$valor_pesquisar%' OR cod_spn LIKE '%$valor_pesquisar%'";
  // print_r($livros);
  // exit();
  $query_livro = $_SESSION['conexao']->query($livros);


  //Contar o total de livros
  $num_total = mysqli_num_rows($query_livro);

  //Seta a quantidade de livros por pagina
  $quantidade = 2;

  //calcular o número de pagina necessárias para apresentar os livros
  $pagina_total = ceil($num_total / $quantidade);

  //Calcular o inicio da visualização
  $incio = ($quantidade * $pagina) - $quantidade;

  //Selecionar os livros a serem apresentado na página
  $sql_total = "SELECT * FROM cad_livro WHERE nome_livro LIKE '%$valor_pesquisar%' OR cod_spn LIKE '%$valor_pesquisar%' LIMIT $incio, $quantidade"; //cod --> identificação= aaaa ou bbbb
  $resp_total = mysqli_query($_SESSION['conexao'], $sql_total);
  $num_total = mysqli_num_rows($resp_total);

  echo '<div class="col-lg-6 grid-margin stretch-card" style="margin: 0 auto;">
      <div class="card">
      <div class="card-body">
      <div class="row" style="margin: 0 auto;">
      <div class="col-lg-12">';

  if ($num_total > 0) {
    while ($linha = mysqli_fetch_assoc($resp_total)) {


      echo '<h3>' . $linha['nome_livro'] . '</h3>
          <p><strong>Id do Livro:</strong> ' . $linha['id_livro'] . '
          <br><strong>Nome:</strong> ' . $linha['nome_autor'] . ' <br><strong>Editora:</strong> ' . $linha['editora'] . '
          <br><strong>Categoria:</strong> ' . $linha['categoria'] . '
          <br><strong>Emissão:</strong> ' . date('d-m-Y', strtotime($linha['emissao'])) . '
          <br><strong>Cadastro:</strong> ' . date('d-m-Y', strtotime($linha['data_cad'])) . '
          <br><strong>SPN:</strong> ' . $linha['cod_spn'] . '
          <br><strong>Cód. de Barra:</strong> ' . $linha['cod_barra'] . '</p>
          
          <hr>
          ';
    }
  }else {
    echo '<center><p class="text-danger">Nenhum resultado encontrado</p></center>';
  }
  echo '</div></div></div></div></div>';

  $exibir = 3;
  $anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
  $posterior = (($pagina + 1) >= $pagina_total) ? $pagina_total : $pagina + 1;

  echo '<br><center><nav class="col-lg-5"><ul class="pagination">
      <li class="page-item"><a class="page-link" href="home.php?pesquisar=' . $valor_pesquisar . '">Todos</a></li> 
      <li class="page-item"><a class="page-link" href="buscar.php?pagina=1&pesquisar=' . $valor_pesquisar . '">Primeira</a></li>
      <li class="page-item"><a aria-label="Previous" class="page-link" href="buscar.php?pagina=' . $anterior . '&pesquisar=' . $valor_pesquisar . '"> < </a></li>';

  //Quantidade de registros/páginas anteriores
  for ($i = $pagina - $exibir; $i <= $pagina - 1; $i++) {
    if ($i > 0) {
      echo '<li class="page-item"><a class="page-link" href="buscar.php?pagina=' . $i . '&pesquisar=' . $valor_pesquisar . '">' . $i . '</a></li>';
    }
  }

  //Página atual/ número central				
  echo '<li class="page-item"><a class="active page-link" href="buscar.php?pagina=' . $pagina . '&pesquisar=' . $valor_pesquisar . '">' . $pagina . '</a></li>';

  //Quantidade de registros/páginas posteriores
  for ($i = $pagina + 1; $i < $pagina + $exibir; $i++) {
    if ($i <= $pagina_total) {
      echo '<li class="page-item"><a class="page-link" href="buscar.php?pagina=' . $i . '&pesquisar=' . $valor_pesquisar . '"> ' . $i . ' </a></li>';
    }
  }

  echo '<li class="page-item"><a aria-label="Next" class="page-link" href="buscar.php?pagina=' . $posterior . '&pesquisar=' . $valor_pesquisar . '"> > </a></strong></li>';
  echo '<li class="page-item"><a class="page-link" href="buscar.php?pagina=' . $pagina_total . '&pesquisar=' . $valor_pesquisar . '">Última</a></li></ul></nav></center>';
}

include_once 'include/footer.php';

?>


<style>
  .pagination a {
    color: black;
    float: left;
    padding: 4px 13px;
    text-decoration: none;
    transition: background-color .3s;
    border: 1px solid #ddd;
    margin: 0 3px;
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