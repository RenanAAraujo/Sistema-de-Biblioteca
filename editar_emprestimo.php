<?php
include_once('conexao.php');
include_once('include/header.php');


if(isset($_POST['nome_aluno'])){

	//echo 'Clicou no btn enviar';
    $id_opcao = $_POST['id_opcao'];
	  $nome_aluno  = $_POST['nome_aluno'];
    $num_id = $_POST['num_id'];
	  $num_id = $_POST['num_id'];
	  $data_f = $_POST['data_f'];
    

	$sql = "UPDATE emprestimo SET nome_aluno = '$nome_aluno', num_id = $num_id, data_f = '$data_f' WHERE id_opcao = $id_opcao";
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	
	if($rodar_sql === TRUE){ // IGUAL A LIKE
    echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dados atualizados</label></center>';
  }else{
    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao atualizar</label></center>';
  }

    $sql2 = "SELECT * FROM emprestimo WHERE id_opcao = ".$id_opcao;
	$rodar_sql2 = mysqli_query($_SESSION['conexao'], $sql2);
	$linha = mysqli_fetch_array($rodar_sql2, MYSQLI_ASSOC);

}else{
	
	$id_get = $_GET['id_opcao'];
	$sql3 = "SELECT * FROM emprestimo WHERE id_opcao = ".$id_get;
	$rodar_sql3 = mysqli_query($_SESSION['conexao'], $sql3);
	$linha = mysqli_fetch_array($rodar_sql3, MYSQLI_ASSOC);
	

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
<center><h3 class="welcome-text" style="color: #a8b3ab;">Editar <span class="text-primary fw-bold">Empréstimos</span></h3></center>
              <div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="editar_emprestimo.php" method="post">
                  <input type="hidden" name="id_opcao" value="<?php echo $id_get; ?>">

                    <div class="form-group">
                      <label >Nome do Aluno</label>
                      <input type="text" class="form-control"  name="nome_aluno" value="<?php echo $linha['nome_aluno']; ?>">
                    </div>

                    <div class="form-group">
                      <label >RA do Aluno</label>
                      <input type="text" class="form-control"  name="num_id" value="<?php echo $linha['num_id']; ?>">
                    </div>
                    
                    <div class="form-group">
                      <label >Data de Devolução</label>
                      <input type="text" class="form-control"  name="data_f" value="<?php echo $linha['data_f']; ?>">
                    </div>


                    <center><button type="submit" class="btn btn-primary me-2" value="Enviar">Salvar</button></center>
                  </form>
                </div>
              </div>
            </div>
          <center><br><button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i><a href="lista_emprestados.php">Voltar</a></button><br></center>
         


<?php
include_once('include/footer.php');
?>

<style>
a{
text-decoration: none;
color: white;
}
a:hover{
color: white;
}

</style>