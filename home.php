
<?php

include_once('conexao.php');

include_once('include/header.php');

include_once('include/funcao.php');


$quantidade = 3;
$pagina = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


$sql = "SELECT * FROM cad_livro ORDER BY id_livro DESC LIMIT $inicio,$quantidade";
$resp_sql = mysqli_query($_SESSION['conexao'], $sql);

echo '<br>';

?>

<!--  -->
<!-- partial -->
<h3 class="welcome-text" style="color: #a8b3ab;">Lista<span class="text-primary fw-bold"> Geral</span></h3><br>

<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
  <div class="row">

  <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Livros emprestados</p>
                            <h3 class="rate-percentage"><?php echo livroempr(); ?></h3>
                            <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>-0.5%</span></p> -->
                          </div>
                          <div>
                            <p class="statistics-title">Total de livros</p>
                            <h3 class="rate-percentage"><?php echo livrototal(); ?></h3>
                            <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+0.1%</span></p> -->
                          </div>
                          <div>
                            <p class="statistics-title">Empréstimos Atrasados</p>
                            <h3 class="rate-percentage"><?php echo livroatra(); ?></h3>
                            <!-- <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>68.8</span></p> -->
                          </div>
                          <div class="d-none d-md-block">
                            <p class="statistics-title">Total de Alunos</p>
                            <h3 class="rate-percentage"><?php echo usutotal(); ?></h3>
                            <!-- <p class="text-success d-flex"><i class="mdi mdi-menu-down"></i><span>+0.8%</span></p> -->
                          </div>
                     
                        </div>
                      </div>
                    </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <hr>
                    <br>
                    <br>

    
      <br>
      <div class="col-lg-10 grid-margin stretch-card" style="margin: 0 auto;">
        <div class="card">
          <div class="card-body">

            <?php
            echo '<div class="row" style="margin: 0 auto;">
            <div class="col-lg-12">';

            while ($linha = mysqli_fetch_assoc($resp_sql)) {

              if ($linha['status'] == 1) {
                $teste = '<label class="badge badge-success">Disponível</label>';
              } else {
                $teste = '<label class="badge badge-warning">Indisponível</label>';
              }

              echo '<center><h3>' . $linha['nome_livro'] . '</h3></center> 
              <br><strong>Autor:</strong> ' . $linha['nome_autor'] . ' <br><strong>Editora:</strong> ' . $linha['editora'] . ' 
              <br><strong>Categoria:</strong> ' . $linha['categoria'] . ' 
              <br><strong>Emissão:</strong> ' . date('d-m-Y', strtotime($linha['emissao'])) . ' 
              <br><strong>Cadastro:</strong> ' . date('d-m-Y', strtotime($linha['data_cad'])) . ' 
              <br><strong>SPN:</strong> ' . $linha['cod_spn'] . ' 
              <br><strong>Cód. de Barra:</strong> ' . $linha['cod_barra'] . ' <br>
              <br><strong ' . $linha['status'] . '>Status:</strong> ' . $teste . '</p> 
         
              ';

              if ($linha['status'] == 0) {
                echo '<p class="template-demo text-danger">Não é possível acessar esse livro</p><hr>';
              } else {
                echo '<p class="template-demo">
                    <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_livro.php?id_livro=' . $linha['id_livro'] . '">Editar</a></button>
                    <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_livro.php?id_livro=' . $linha['id_livro'] . '">Deletar</a></button>
                    </p>
                    <hr>';
              }
            }
            echo '</div></div></div>';

            $sql_total = 'SELECT id_livro FROM cad_livro';
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

    echo '<li class="page-item"><a class="active page-link" href="?pagina=' . $pagina . '"><strong>' . $pagina . '</strong></a></li>';

    for ($i = $pagina + 1; $i < $pagina + $exibir; $i++) {
      if ($i <= $pagina_total)
        echo '<li class="page-item"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
    }
    echo '<li class="page-item"><a aria-label="Next" class="page-link" href="?pagina=' . $posterior . '">></a></li>';
    echo '<li class="page-item"><a class="page-link" href="?pagina=' . $pagina_total . '">Ultima</a></li></ul></nav>';
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
  include_once('include/footer.php');
  ?>