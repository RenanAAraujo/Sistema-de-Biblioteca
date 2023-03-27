<?php 
include_once('conexao.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql="UPDATE contatos SET status = 0 WHERE id = $id";
    $resp_query=mysqli_query($conn,$sql);

    if($resp_query){
        header('Location:lista_contatos.php'); 
    }else{
        echo 'Erro ao deletar dados!';
    }

    
}

?>