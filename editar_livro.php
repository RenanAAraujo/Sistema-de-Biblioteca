<?php

include_once('conexao.php');
include_once('include/header.php');

if(isset($_GET['id_livro'])){

	$id_livro = $_GET['id_livro'];
	
	$sql = "SELECT * FROM cad_livro WHERE id_livro = ".$id_livro;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);

}else{
	//echo 'Clicou no btn enviar';
  $id_livro = $_POST['id_livro'];
	$cod_spn  = $_POST['cod_spn'];
	$cod_barra = $_POST['cod_barra'];
	$nome_livro = $_POST['nome_livro'];
  $nome_autor = $_POST['nome_autor'];
  $emissao = $_POST['emissao'];
	$editora = $_POST['editora'];	
  $categoria = $_POST['categoria'];
	$data_cad = $_POST['data_cad'];

	$sql = "UPDATE cad_livro SET cod_spn = '$cod_spn', cod_barra = $cod_barra, nome_livro = '$nome_livro', nome_autor = '$nome_autor', emissao = '$emissao', editora = '$editora', categoria = '$categoria', data_cad = '$data_cad'  WHERE id_livro = $id_livro";
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	
  if($rodar_sql === TRUE){ // IGUAL A LIKE
    echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dados atualizados</label></center>';
  }else{
    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao atualizar</label></center>';
  }
	
	$sql = "SELECT * FROM cad_livro WHERE id_livro = ".$id_livro;
	$rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
	$resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);
	
	$id_livro = $resp_sql['id_livro'];
	
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
<center><h3 class="welcome-text" style="color: #a8b3ab;">Editar <span class="text-primary fw-bold">Livros</span></h3></center>

<div class="col-md-6 grid-margin stretch-card" style="margin: 0 auto;">
              <div class="card">
                <div class="card-body">
                  <form class="forms-sample" action="editar_livro.php" method="post">
                  <input type="hidden" name="id_livro" value="<?php echo $id_livro; ?>">

                    <div class="form-group">
                      <label >Código Barra</label>
                      <input type="text" class="form-control"  name="cod_barra" value="<?php echo $resp_sql['cod_barra']; ?>">
                    </div>

                    <div class="form-group">
                      <label >Nome do Livro</label>
                      <input type="text" class="form-control"  name="nome_livro" value="<?php echo $resp_sql['nome_livro']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Nome do autor</label>
                      <input type="text" class="form-control"  name="nome_autor" value="<?php echo $resp_sql['nome_autor']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Emissão</label>
                      <input type="date" class="form-control"  name="emissao" value="<?php echo $resp_sql['emissao']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Editora</label>
                      <input type="text" class="form-control"  name="editora" value="<?php echo $resp_sql['editora']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Categoria</label>
                      <input type="text" class="form-control"  name="categoria" value="<?php echo $resp_sql['categoria']; ?>">
                    </div>
                    <div class="form-group">
                      <label >Data de Cadastro</label>
                      <input type="date" class="form-control"  name="data_cad" value="<?php echo $resp_sql['data_cad']; ?>">
                    </div>

                    <div class="form-group">
                      <label >Código SPN</label>
                      <input type="text" class="form-control"  name="cod_spn" value="<?php echo $resp_sql['cod_spn']; ?>">
                    </div>
                    <center> <button type="submit" name="Salvar" class="btn btn-primary me-2">Atualizar</button></center>
                </form>
              </div>
            </div>
          </div>
        <br><center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button></center>



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
