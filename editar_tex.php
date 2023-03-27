<?php

include_once('conexao.php');
include_once('include/header.php');

if(isset($_GET['id_tex'])){

	$id_tex = $_GET['id_tex'];
	
	$sql = "SELECT * FROM relatorio_texto WHERE id_tex = ".$id_tex;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);

}else{
	//echo 'Clicou no btn enviar';
  $id_tex = $_POST['id_tex'];
  $texto = $_POST['texto'];
	

	$sql = "UPDATE relatorio_texto SET texto = '$texto' WHERE id_tex = $id_tex";
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	
  if($rodar_sql === TRUE){ // IGUAL A LIKE
    echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dados atualizados</label></center>';
  }else{
    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao atualizar</label></center>';
  }
	
	$sql = "SELECT * FROM relatorio_texto WHERE id_tex = ".$id_tex;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);
	
	$id_tex = $resp_sql['id_tex'];
	
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
<!--<center><h3 class="welcome-text" style="color: #a8b3ab;">Editar <span class="text-primary fw-bold">Relatório</span></h3></center>-->

<br><br><br><center><h3 class="welcome-text" style="color: #a8b3ab;">Editar <span class="text-primary fw-bold"> Relatorio Adicional</span></h3></center>
  <div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
  <div class="card">
    <div class="card-body">
                  <form class="forms-sample" action="editar_tex.php" method="post">
                  <input type="hidden" name="id_tex" value="<?php echo $id_tex; ?>">

                    <div class="form-group">
                   
                      <!-- <input type="text" class="form-control"  name="texto" value="> -->
                      <center><textarea name="texto" id="" cols="80" rows="15" class="" placeholder=" Relatório..." maxlength="100000000"></textarea> </center>  
                    </div>
                    
                    <center><button type="submit" name="Salvar" class="btn btn-primary me-2">Atualizar</button><center>
                </form>
              </div>
            </div>
          </div>
        <br><center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="relatorioSemanal.php">Voltar</a></button></center>



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
