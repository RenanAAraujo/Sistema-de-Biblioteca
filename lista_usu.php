<?php
include_once('conexao.php');
include_once('include/header.php');


$quantidade = 4;
$pagina  = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


$sql = "SELECT * FROM cad_usu WHERE status = 1 ORDER BY nome_aluno LIMIT $inicio,$quantidade";
$resp_sql = mysqli_query($_SESSION['conexao'],$sql);

echo '<br>';
echo '<center><h4 class="welcome-text" style="color: #a8b3ab;">Alunos <span class="text-primary fw-bold">Cadastrados</span></h4></center><br>
<div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
<div class="card">
  <div class="card-body">
<div class="row">
<div class="col-lg-30">   
      ';

while($linha= mysqli_fetch_array($resp_sql)){

  if($linha['status']== 1){
    $teste = '<label class="badge badge-success">Ativo</label>';
 }else{
   $teste = '<label class="badge badge-danger">Inativo</label>';
   
 }

 echo '<h4>'.$linha['nome_aluno'].'</h4>
 <p><strong>RA do Aluno:</strong> '.$linha['num_id'].'
 <br><strong>Turma:</strong> '.$linha['turma'].' 
 <br><strong>Email:</strong> '.$linha['email'].'
 <br><strong '.$linha['status'].'>Status:</strong> '.$teste.'</p>
 
 <p class="template-demo">
 <button type="button" class="btn btn-info btn-rounded btn-sm"><a id="link" href="editar_usuario.php?id_usu='.$linha['id_usu'].'">Editar</a></button>
 <button type="button" class="btn btn-warning btn-rounded btn-sm"><a id="link" href="deletar_aluno.php?id_usu='.$linha['id_usu'].'">Deletar</a></button>
 </p>
 <hr>
 ';
}        
echo '</div></div></div></div></div> ';
                 


$sql_total = 'SELECT id_usu FROM cad_usu';
$resp_total= mysqli_query($_SESSION['conexao'],$sql_total);
$num_total = mysqli_num_rows($resp_total);
$pagina_total = ceil($num_total/$quantidade);
$exibir = 3;
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina+1) >= $pagina_total) ? $pagina_total : $pagina+1;

?>
<br><br>
<center>
 <?php
 
 echo '<br><nav id="pag"><ul class="pagination">
 <li class="page-item"><a class="page-link" href ="?pagina=1">Primeira</a></li>';
 echo '<li class="page-item"><a aria-label="Previous" class="page-link" href ="?pagina='.$anterior.'"><</a></li>';


 for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
     if($i > 0 )
     echo '<li class="page-item"><a class="page-link" href ="?pagina='.$i.'">'.$i.'</a></li>';
 }

 echo '<li class="page-item"><a class="active page-link" href="?pagina='.$pagina.'"><strong>'.$pagina.'</strong></a></li>';

 for($i = $pagina+1; $i < $pagina+$exibir; $i++){
     if($i <= $pagina_total)
     echo '<li class="page-item"><a class="page-link" href="?pagina='.$i.'">'.$i.'</a></li>';
 }
 echo '<li class="page-item"><a aria-label="Next" class="page-link" href="?pagina='.$posterior.'">></a></li>';
 echo '<li class="page-item"><a class="page-link" href="?pagina='.$pagina_total.'">Ultima</a></li></ul></nav>';
?>
</center>


<style>

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

#link{
    text-decoration: none;
    color: white;
  }
  #link:hover{
    color: white;
  }
 

.pagination a.active {
  background-color: #035afc;
  color: white;
 
}

.pagination a:hover:not(.active) {background-color: #ddd;}

#img1{
  width:32px;
  height:32px;
}
</style>

<?php

include_once 'include/footer.php';

?>