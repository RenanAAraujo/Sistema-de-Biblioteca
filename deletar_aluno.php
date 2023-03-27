<?php 
include_once('conexao.php');
include_once 'include/header.php';

if(isset($_GET['id_usu'])){
    $id_usu = $_GET['id_usu'];

    $sql="DELETE FROM cad_usu WHERE id_usu = $id_usu";
    $resp_query=mysqli_query($_SESSION['conexao'],$sql);

    if($resp_query){
        echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dado deletado com sucesso!</label></center>';

    }else{
        echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Opss! Erro ao deletar dado!</label></center>';

    }

    
}

?>



<center><br><button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i><a href="lista_emprestados.php">Voltar</a></button></center>

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