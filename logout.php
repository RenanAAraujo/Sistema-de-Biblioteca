<?php

include_once 'conexao.php';

if (isset($_GET['logout']) == 'sair') {

    $_SESSION['email'] = null;
    $_SESSION['senha'] = null;
    $_SESSION['conexao'] = null;
    session_destroy();

}
header('Location:adm.php');


?>