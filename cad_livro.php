<?php
include_once('include/header.php');
include_once('conexao.php');

if (isset($_POST['Enviar'])) {
  $cad_livro = "Realizou cadastro de um livro";
  $cod_spn = $_POST['cod_spn'];
  $cod_barra = $_POST['cod_barra'];
  $nome_livro = $_POST['nome_livro'];
  $nome_autor = $_POST['nome_autor'];
  $emissao = $_POST['emissao'];
  $editora = $_POST['editora'];
  $categoria = $_POST['categoria']; 


  $livro = "SELECT * FROM cad_livro WHERE cod_barra = $cod_barra AND cod_spn = '$cod_spn'";
  $roda = $_SESSION['conexao']->query($livro);

  if (mysqli_num_rows($roda) > 0) {

    echo '<br><center><label class="badge badge-warning" style="font-size:medium;">O livro com o código de barra ' . $cod_barra . ' e o código spn ' . $cod_spn . ' já existe</label></center>';

  } else {

    $sql = "INSERT INTO cad_livro (cod_spn,cod_barra,nome_livro,nome_autor,emissao,editora,categoria,data_cad, cad_livro) VALUES ('$cod_spn',$cod_barra,'$nome_livro','$nome_autor', '$emissao', '$editora', '$categoria', NOW(), '$cad_livro')";
    $resp_sql = mysqli_query($_SESSION['conexao'], $sql);

   

    if ($resp_sql === TRUE) { 
      $sql_rel = "INSERT INTO relatorio_cad_livro (cod_spn,cod_barra,nome_livro,nome_autor,emissao,editora,categoria,data_cad, cad_livro) VALUES ('$cod_spn',$cod_barra,	'$nome_livro', '$nome_autor', '$emissao', '$editora', '$categoria', NOW(), '$cad_livro')";
      $resp_sql_rel = mysqli_query($_SESSION['conexao'], $sql_rel);
      echo '<br><center><label class="badge badge-success" style="font-size:medium;">Cadastro realizado</label></center>';
    } else {
      echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao cadastrar</label></center>';
    }
  }
}

?>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Biblioteca SENAI </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<div class="tab-content tab-content-basic">



  <br>
  <center>
    <h3 class="welcome-text" style="color: #a8b3ab;">Cadastro de<span class="text-primary fw-bold"> Livros</span></h3>
  </center>
  <div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body">

        <form class="forms-sample" action="cad_livro.php" method="post">

          

          <div class="form-group">
            <label>Nome do Livro</label>
            <input type="text" class="form-control" name="nome_livro" placeholder="Livro">
          </div>

          <div class="form-group">
            <label>Nome do autor</label>
            <input type="text" class="form-control" name="nome_autor" placeholder="Autor">
          </div>

          <div class="form-group">
            <label>Emissão</label>
            <input type="date" class="form-control" name="emissao" placeholder="Data de emissão">
          </div>

          <div class="form-group">
            <label>Editora</label>
            <input type="text" class="form-control" name="editora" placeholder="Editora">
          </div>

     
                  
          <div class="form-group">
            <label>Categoria:</label><br>
            <!-- <input type="text" class="form-control" name="categoria" placeholder="Categoria"> -->
            <select name="categoria" id="categoria">
           <option value="">Categoria </option>

           <option value="Folheto">Folheto</option>
           <option value="Revista">Revista</option>
           <option value="Livro Técnico">Livro Técnico</option>
           <option value="Outros">Outros</option>
            </select>
          </div>

          <div class="form-group">
            <label>Código SPN</label>
            <input type="text" class="form-control" name="cod_spn" placeholder="Código SPN">
          </div>

          <div class="form-group">
            <label>Código Barra</label>
            <input type="text" class="form-control" name="cod_barra" placeholder="Código de barra">
          </div>

          <center><button type="submit" name="Enviar" class="btn btn-primary me-2" value="Enviar">Cadastrar</button> </center>
        </form>
      </div>
    </div>
  </div>
  <center><br><button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button></center>

  <style>
    a {
      text-decoration: none;
      color: white;
    }

    a:hover {
      color: white;
    }

    #categoria{
      border-radius: 50px;
    }
  </style>

  <br>
  <?php
  include_once('include/footer.php');
  ?>
  

