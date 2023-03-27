<?php

include_once('conexao.php');
include_once('include/header.php');


if (isset($_POST['enviar']) != '') {

  $num_id = $_POST['num_id'];
  $nome_aluno = $_POST['nome_aluno'];
  $turma = $_POST['turma'];
  $email = $_POST['email'];

  $sql = "SELECT * FROM cad_usu WHERE num_id=$num_id";
  $resp = mysqli_query($_SESSION['conexao'], $sql);
  $dados = mysqli_num_rows($resp);

    if ($dados > 0) {

      echo '<br><center><label class="badge badge-warning" style="font-size:medium;">O Id ' . $num_id . ' já exite, tente novamente</label></center>';
    } else {

      $sql = "INSERT INTO cad_usu (num_id,nome_aluno,turma,email) VALUES ($num_id,'$nome_aluno','$turma', '$email')";
      $resp_sql = mysqli_query($_SESSION['conexao'], $sql);

      if ($resp_sql === TRUE) {
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
    <h3 class="welcome-text" style="color: #a8b3ab;">Cadastro de <span class="text-primary fw-bold">Alunos</span></h3>
  </center>
  <div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample" action="cad_usu.php" method="post">

          <div class="form-group">
            <label>RA</label>
            <input type="text" class="form-control" name="num_id" placeholder="RA">
          </div>
          <div class="form-group">
            <label>Nome do Aluno</label>
            <input type="text" class="form-control" name="nome_aluno" placeholder="Nome do Aluno">
          </div>
          <div class="form-group">
            <label>Turma</label>
            <input type="text" class="form-control" name="turma" placeholder="Turma">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>

         <center> <button type="submit" class="btn btn-primary me-2" name="enviar" value="enviar">Cadastrar</button>  </center>
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
  </style>


  <?php
  include_once('include/footer.php');
  ?>