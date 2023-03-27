<?php 
 
include_once('conexao.php');
include_once('include/header.php');


if(isset($_POST['enviar'])) {

  //Verifica se o campo nome_aluno esta vazio e da um feedback ao usuario do sistema
  if(empty($_POST['nome_aluno'])){

    echo '<br><center><label class="badge badge-warning" style="font-size:medium;"> Por favor preencha o nome do aluno! </label></center>';

  //Verifica se o campo num_id esta vazio e da um feedback ao usuario do sistema
    }else if(empty($_POST['num_id'])){

      echo '<br><center><label class="badge badge-warning" style="font-size:medium;">Por favor  preencha o RA do aluno! </label></center>';

  //Verifica se o campo email esta vazio e da um feedback ao usuario do sistema
    } else if (empty($_POST['email'])){
      echo '<br><center><label class="badge badge-warning" style="font-size:medium;"> Por favor preencha o email do aluno! </label></center>';

  //Verifica se o campo cod_spn esta vazio e da um feedback ao usuario do sistema
    } else if (empty($_POST['cod_spn'])){
      echo '<br><center><label class="badge badge-warning" style="font-size:medium;"> Por favor preencha o código SPN do livro! </label></center>';

  //Verifica se o campo nome_livro esta vazio e da um feedback ao usuario do sistema
}else if (strlen($_POST['nome_livro']) == 0){
      echo '<br><center><label class="badge badge-warning" style="font-size:medium;">  Por favor preencha o nome do livro! </label></center>';

    }else{

  $emprestimo = "Realizou empréstimo";
  $nome_aluno = $_POST['nome_aluno'];
  $num_id = $_POST['num_id'];
  $email = $_POST['email'];
  $cod_spn = $_POST['cod_spn'];
  $cod_spn2 = $_POST['cod_spn2'];
  $cod_spn3 = $_POST['cod_spn3'];
  $nome_livro = $_POST['nome_livro'];
  $nome_livro2 = $_POST['nome_livro2'];
  $nome_livro3 = $_POST['nome_livro3'];
  $data_f = date('Y-m-d', strtotime("+21 days"));

  //Checa se o livro existe no banco
  $livro_query = "SELECT * FROM cad_livro WHERE nome_livro= '$nome_livro' AND cod_spn = '$cod_spn'";
  $roda_livro = $_SESSION['conexao']->query($livro_query);

  //Checa se a pessoa está cadastrada
  $usuario_query = "SELECT * FROM cad_usu WHERE num_id= $num_id AND nome_aluno = '$nome_aluno' AND email = '$email'";
  $roda_usu = $_SESSION['conexao']->query($usuario_query);


  // Verifica se o livro já está emprestado  
  $emp_query = "SELECT * FROM emprestimo WHERE cod_spn='$cod_spn' AND status = 1";
  $roda_emp = $_SESSION['conexao']->query($emp_query);

  // $emp_query2 = "SELECT * FROM emprestimo WHERE cod_spn2='$cod_spn2' AND status = 1";
  // $roda_emp2 = $_SESSION['conexao']->query($emp_query2);

  // $emp_query3 = "SELECT * FROM emprestimo WHERE cod_spn3='$cod_spn3' AND status = 1";
  // $roda_emp3 = $_SESSION['conexao']->query($emp_query3);

  if (mysqli_num_rows($roda_livro) == 0 && mysqli_num_rows($roda_usu) == 0) {
    echo '<br><center><label class="badge badge-warning" style="font-size:medium;"> O ' . $nome_livro . ' não existe ou o nome está incorreto</label></center>';
  
  } elseif (mysqli_num_rows($roda_usu) == 0) {
    echo '<br><center><label class="badge badge-warning" style="font-size:medium;">' . $nome_aluno . ' não está no sistema ou ID está incorreto</label></center>';

  } elseif (mysqli_num_rows($roda_emp) > 0) {
    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">OPS! Esse livro já foi emprestado</label></center>';

  } 
  // elseif (mysqli_num_rows($roda_emp2) > 0) {
  //   echo '<br><center><label class="badge badge-danger" style="font-size:medium;">OPS! Esse livro já foi emprestado</label></center>';

  // } elseif (mysqli_num_rows($roda_emp3) > 0) {
  //   echo '<br><center><label class="badge badge-danger" style="font-size:medium;">OPS! Esse livro já foi emprestado</label></center>';
  // } 
  else {


    //Insere os dados do form na tabela de empréstimo
    $insert = "INSERT INTO emprestimo( nome_aluno,num_id,email,nome_livro,nome_livro2,nome_livro3,cod_spn, cod_spn2, cod_spn3, emprestimo,data_e,data_f) VALUES 
    ('$nome_aluno', $num_id, '$email', '$nome_livro','$nome_livro2','$nome_livro3','$cod_spn','$cod_spn2','$cod_spn3','$emprestimo', NOW(),'$data_f')";
    $resp_sql = mysqli_query($_SESSION['conexao'], $insert);

    if ($resp_sql === TRUE) {

    //Insere os dados do form na tabela de relatório
      $insert2 = "INSERT INTO relatorio( nome_aluno,num_id,email,nome_livro,nome_livro2,nome_livro3,cod_spn, cod_spn2, cod_spn3, emprestimo,data_e,data_f) VALUES 
      ('$nome_aluno', $num_id, '$email', '$nome_livro','$nome_livro2','$nome_livro3','$cod_spn','$cod_spn2','$cod_spn3','$emprestimo', NOW(),'$data_f')";
      $resp_sql2 = mysqli_query($_SESSION['conexao'], $insert2);

      echo '<br><center><label class="badge badge-success" style="font-size:medium;">Empréstimo realizado com sucesso!</label></center>';

        //Faz uma atualização do status do livro na tabela cad_livro o tornando indisponivel na lista principal
      $sql_up = "UPDATE cad_livro SET status= 0 WHERE cod_spn='$cod_spn'";
      $resp_sql = mysqli_query($_SESSION['conexao'], $sql_up);

        //Faz uma atualização do status do livro na tabela cad_livro o tornando indisponivel na lista principal
      $sql_up2 = "UPDATE cad_livro SET status= 0 WHERE cod_spn='$cod_spn2'";
      $resp_sql22 = mysqli_query($_SESSION['conexao'], $sql_up2);

        //Faz uma atualização do status do livro na tabela cad_livro o tornando indisponivel na lista principal
      $sql_up3 = "UPDATE cad_livro SET status= 0 WHERE cod_spn='$cod_spn3'";
      $resp_sql3 = mysqli_query($_SESSION['conexao'], $sql_up3);


    } else {
      echo '<br><center><label class="badge badge-danger" style="font-size:medium;">OPS! Houve um erro ao realizar o empréstimo!</label></center>';
    }
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


<br>
<center>
  <h3 class="welcome-text" style="color: #a8b3ab;"><span class="text-primary fw-bold">Empréstimos</span></h3>
</center>
<div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
  <div class="card">
    <div class="card-body">

      <form id="form1" class="forms-sample" action="emprestimo.php" method="post">

        <div class="form-group">
          <label>Nome do Aluno</label>
          <input type="text" class="form-control" name="nome_aluno" placeholder="Nome do aluno">
        </div>

        <div class="form-group">
          <label>RA do aluno</label>
          <input type="int" class="form-control" name="num_id" placeholder="RA">
        </div>

        <div class="form-group">
          <label>Email do Aluno</label>
          <input type="text" class="form-control" name="email" placeholder="email">
        </div>

        <div class="form-group">
          <label>Nome do Livro </label>
          <input type="text" class="form-control" name="nome_livro" placeholder="Nome do Livro" id="nome_livro">
        </div>

        <div class="form-group">
          <label>Código SPN </label>
          <input type="text" class="form-control" name="cod_spn" placeholder="Código">
        </div>

        <div class="form-group">
          <label>Nome do Livro 2</label>
          <input type="text" class="form-control" name="nome_livro2" placeholder="Nome do Livro" id="nome_livro">
        </div>

        <div class="form-group">
          <label>Código SPN 2</label>
          <input type="text" class="form-control" name="cod_spn2" placeholder="Código">
        </div>

        <div class="form-group">
          <label>Nome do Livro 3</label>
          <input type="text" class="form-control" name="nome_livro3" placeholder="Nome do Livro" id="nome_livro">
        </div>

        <div class="form-group">
          <label>Código SPN 3</label>
          <input type="text" class="form-control" name="cod_spn3" placeholder="Código">
        </div>

        <input type="hidden" class="form-control" name="data_e" placeholder="Data">
        <div class="form-group">
          <label>Data de devolução </label>
          <input type="date" class="form-control" name="data_f" placeholder="Data">
        </div>
        
        <div class="template-demo">
          <center>
            <button type="submit" name="enviar" class="btn btn-primary me-2" value="Enviar">Empréstimo</button>
            <br>
            <br>

            <br>
            <br>
      </form>
   
    </div>
    </center>
  </div>
</div>
</div>
<center><br><button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i>Voltar</a></button></center>


<style>
  a {
    text-decoration: none;
    color: white;
  }

  a:hover {
    color: white;
  }
</style>

<br>
<?php
include_once('include/footer.php');
?>