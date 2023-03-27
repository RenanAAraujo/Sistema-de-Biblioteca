<?php

include_once('conexao.php');
include_once('include/header.php');

$sql = "SELECT * FROM emprestimo ORDER BY id_opcao DESC LIMIT 1";
$resp_query = mysqli_query($_SESSION['conexao'], $sql);

?>
<center><h3 class="welcome-text" style="color: #a8b3ab;">Compro<span class="text-primary fw-bold">vante</span></h3><br></center>
<div class="col-lg-5 grid-margin stretch-card" style="margin: 0 auto;">
  <div class="card">
    <div class="card-body">

      <?php

      echo '<div class="row">
  <div class="col-lg-12">';

      while ($linha = mysqli_fetch_array($resp_query)) {

        $nome_aluno = $linha['nome_aluno'];
        $num_id = $linha['num_id'];
        $email = $linha['email'];
        $nome_livro = $linha['nome_livro'];
        $cod_spn = $linha['cod_spn'];
        $data_e = date('d-m-Y', strtotime($linha['data_e']));
        $data_f = date('d-m-Y', strtotime($linha['data_f']));


        echo '<h3>' . $nome_aluno . '</h3>
              <p><strong>RA do Aluno:</strong> ' . $num_id . '
              <br><strong>E-mail:</strong> ' . $email . '
              <br><strong>Livro:</strong> ' . $nome_livro . '
              <br><strong>SPN:</strong> ' . $cod_spn . '
              <br><strong>Data de Empréstimo:</strong> ' . $data_e . '
              <br><strong>Data de Devolução:</strong> ' . $data_f . ' 
              </p>';
      }

      echo '</div></div>';
      ?>
    </div>
  </div>
</div>

<br>
<center>
  <div class="template-demo"> <button type='submit' class='btn btn-primary me-2' value='Confirmar'><a href='dompdf/gerar_pdf_ativos.php'>Gerar PDF</a></button>
    <button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i><a href="relatorio.php">Voltar</a></button>
  </div>

</center>

<style>
  a {
    text-decoration: none;
    color: white;
  }

  a:hover {
    color: white;
  }

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

  #img1 {
    width: 32px;
    height: 32px;
  }
</style>

<br>
<br>
<br>
<br>
<?php
include_once('include/footer.php');
?>