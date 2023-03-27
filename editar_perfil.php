<?php 
include_once 'conexao.php';
  
include_once('include/header.php');

$sel = "SELECT * FROM cad_login";
$resultado = mysqli_query($_SESSION['conexao'],$sel);

if(isset($_POST['Salvar'])){

$imagem = $_FILES['arquivo_img']['tmp_name'];
$tamanho = $_FILES['arquivo_img']['size'];
$tipo = $_FILES['arquivo_img']['type'];
$nome = $_FILES['arquivo_img']['name'];
$id_num = $_POST['id_num'];
$nome_adm = $_POST['nome'];
$email  = $_POST['email'];
$senha = md5($_POST['senha']);

if(!empty($imagem) && $tipo == "image/png" || $tipo == "image/jpeg"){
    $teste = fopen($imagem, "rb");
    $conteudo = fread($teste, $tamanho);
    $conteudo = mysqli_real_escape_string($_SESSION['conexao'], $conteudo); 
    $imagem_blob = mysqli_real_escape_string($_SESSION['conexao'], file_get_contents($imagem));

    fclose($teste);

    $insert= "UPDATE cad_login SET 
    nome = '$nome_adm', 
    email = '$email', 
    senha = '$senha',
    nome_img='$nome',
    tamanho_img='$tamanho',
    tipo_img='$tipo',
    arquivo_img='$conteudo' WHERE id_num= 1";
    $result = $_SESSION['conexao']->query($insert);

    if($result === TRUE){ // IGUAL A LIKE
      echo '<br><center><label class="badge badge-success" style="font-size:medium;">Dados atualizados</label></center>';
    }else{
      echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Erro ao atualizar</label></center>';
    }

    $sql = "SELECT * FROM cad_login WHERE id_num = 1";
    $rodar_sql = mysqli_query($_SESSION['conexao'], $sql);
    $linha = mysqli_fetch_array($rodar_sql);
    
  }else{
    echo '<br><center><label class="badge badge-warning" style="font-size:medium;">Formato de Imagem Inválido</label></center><br>';
    echo '<center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="editar_perfil.php?id_num=1">Voltar</a></button></center>';
  }
}else{

  $id_get = $_GET['id_num'];
	
	$sql = "SELECT * FROM cad_login WHERE id_num = ".$id_get;
  $resultado = $_SESSION['conexao']->query($sql);
  $linha = $resultado->fetch_assoc();
  $tipo = $linha['tipo_img'];
  $imagem = $linha['arquivo_img'];


}



    // Determina o tipo de conteúdo com base no tipo de imagem e mostra o formulário onde a imagem é do tipo jpeg ou png
    if ($tipo == "image/jpeg"){

      // header("Content-type: image/jpeg");

      echo '<br><br><center> <h4 class="card-title">Editar Perfil</h4><div class="col-md-12 grid-margin stretch-card" style="width: 40%;">
       <div class="card" style="padding-top:15px;">
       <div class="dropdown-header text-center">
         <img class="img-md rounded-circle" src="data:image/jpeg;base64,'.base64_encode($imagem).'" alt="Imagem de perfil" width="40%">
         </div>
         <div class="card-body">
           <form class="forms-sample" method="POST" enctype="multipart/form-data" action="editar_perfil.php">
           <input type="hidden" name="id_num" value="">

             <div class="form-group">
               <label for="exampleInputUsername1">Nome:</label>
               <input type="text" class="form-control" name="nome" id="exampleInputUsername1" placeholder="Nome" value="'.$linha['nome'].'">
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Email:</label>
               <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="'.$linha['email'].'" >
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Senha:</label>
               <input type="password" class="form-control" name="senha" id="exampleInputEmail1" placeholder="Mudar senha">
             </div>
            
             <div class="form-group">
               <input style="align-items:center;" type="file" name="arquivo_img" class="form-control" class="inputfile" >
                
             </div>
             <button type="submit" name="Salvar" class="btn btn-primary me-2">Enviar</button>
           </form>
         </div>
       </div>
     </div>
     <button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button>

</center>';

      if(isset($_POST['Salvar'])){
        echo '<script>
        window.location.href = "home.php";
       </script>';
      }


    }elseif($tipo == "image/png"){ 

      // header("Content-type: image/png");
    
       echo '<br><br><center><h4 class="card-title">Editar Perfil</h4><div class="col-md-12 grid-margin stretch-card" style="width: 40%;">
       <div class="card" style="padding-top:15px;">
       <div class="dropdown-header text-center">
         <img class="img-md rounded-circle" src="data:image/png;base64,'.base64_encode($imagem).'" alt="Imagem de perfil" width="40%">
       </div>
         <div class="card-body">
           <form class="forms-sample" method="POST" enctype="multipart/form-data" action="editar_perfil.php">
           <input type="hidden" name="id_num" value="">

             <div class="form-group">
               <label for="exampleInputUsername1">Nome:</label>
               <input type="text" class="form-control" name="nome" id="exampleInputUsername1" placeholder="Nome" value="'.$linha['nome'].'">
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Email:</label>
               <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="'.$linha['email'].'" >
             </div>
             <div class="form-group">
               <label for="exampleInputEmail1">Senha:</label>
               <input type="password" class="form-control" name="senha" id="exampleInputEmail1" placeholder="Mudar senha">
             </div>
            
             <div class="form-group">
               <input style="align-items:center;" type="file" name="arquivo_img" class="form-control" class="inputfile" >
                
             </div>
             <button type="submit" name="Salvar" class="btn btn-primary me-2">Enviar</button>
           </form>
         </div>
       </div>
     </div>
     <button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button>

</center>';

      if(isset($_POST['Salvar'])){
        echo '<script>
        window.location.href = "home.php";
       </script>';
      }

    }

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





<?php

include_once('include/footer.php');
?>