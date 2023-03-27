<?php 
include_once('conexao.php');
include_once('include/header.php');


if(isset($_GET['id_tex'])){
    $id_tex = $_GET['id_tex'];

    $sql="DELETE FROM relatorio_texto WHERE id_tex = $id_tex";
    $resp_query=mysqli_query($_SESSION['conexao'],$sql);

    if($resp_query){
        echo '<br><br><br><br><center><label class="badge badge-success" style="font-size:medium;">Relatório Deletado</label></center>';
    }else{
        echo '<br><br><br><br><center><label class="badge badge-success" style="font-size:medium;">Ops! Erro ao deletar</label></center>';
    }
}

?>
<br><br><br><br><br><br><br><br><br><br>
<br><center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="relatorioSemanal.php">Voltar</a></button></center>
<br><br><br><br><br><br>
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
