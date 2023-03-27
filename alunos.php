<?php

require 'conexao.php';

// Verifica se o parâmetro "num_id" foi enviado via GET
if(isset($_GET['num_id'])) {
    $user_id = $_GET['num_id'];

    // Verifique se o valor de $user_id é um número inteiro válido antes de realizar a consulta
    if (!is_numeric($user_id) || !is_int($user_id + 0)) {
        echo 'RA do aluno inválido';
        exit;
    }

    // Verifica o valor de "info" e faz a consulta adequada no banco de dados
    if(isset($_GET['info'])) {
        $info = $_GET['info'];

        // Faz a consulta no banco de dados para buscar o nome ou o email do usuário com base no ID
        if($info == 'nome_usu') {
            $query = "SELECT nome_usu FROM cad_usu WHERE num_id = $user_id";
        } elseif($info == 'email') {
            $query = "SELECT email FROM cad_usu WHERE num_id = $user_id";
        }

        $result = mysqli_query($_SESSION['conexao'], $query);

        // Verifica se a consulta foi bem-sucedida e retorna o resultado correto
        if($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            echo $row[$info];
        } else {
            echo 'Não foi possível obter os dados';
        }
    }
}
?>