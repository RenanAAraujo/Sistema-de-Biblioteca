<?php

include_once('conexao.php');
include_once('include/header.php');

if(isset($_GET['id_usu'])){

	$id_usu = $_GET['id_usu'];
	
	$sql = "SELECT * FROM cad_usu WHERE id_usu = ".$id_usu;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);

}else{
	//echo 'Clicou no btn enviar';
  $id_usu = $_POST['id_usu'];
	$num_id  = $_POST['num_id'];
	$nome_usu = $_POST['nome_aluno'];
	$turma = $_POST['turma'];
  $email = $_POST['email'];


	$sql = "UPDATE cad_usu SET num_id = $num_id, nome_aluno = '$nome_aluno', email = '$email' WHERE id_usu = $id_usu";
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	
  if($rodar_sql === TRUE){ // IGUAL A LIKE
    echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dados atualizados</label></center>';
  }else{
    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao atualizar</label></center>';
  }
	
	$sql = "SELECT * FROM cad_usu WHERE id_usu = ".$id_usu;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);
	
	$id_usu = $resp_sql['id_usu'];
	
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

<br><br>
<center><h3 class="welcome-text" style="color: #a8b3ab;">Editar <span class="text-primary fw-bold">Alunos </span></h3></center>

<div class="col-md-4 grid-margin stretch-card" style="margin: 0 auto;">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="editar_usuario.php" method="post">
                  <input type="hidden" name="id_usu" value="<?php echo $id_usu; ?>">

                    <div class="form-group">
                      <label >RA do aluno</label>
                      <input type="text" class="form-control"  name="num_id" value="<?php echo $resp_sql['num_id']; ?>">
                    </div>

                    <div class="form-group">
                      <label >Nome do Usuario</label>
                      <input type="text" class="form-control"  name="nome_aluno" value="<?php echo $resp_sql['nome_aluno']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Turma</label>
                      <input type="text" class="form-control"  name="turma" value="<?php echo $resp_sql['turma']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Email</label>
                      <input type="email" class="form-control"  name="email" value="<?php echo $resp_sql['email']; ?>">
                    </div>
          
                    <button type="submit" name="Salvar" class="btn btn-primary me-2">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        <center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button></center>


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

include_once 'include/footer.php';

?>
