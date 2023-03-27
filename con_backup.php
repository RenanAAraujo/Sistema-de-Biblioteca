<?php

$con = mysqli_connect("localhost","root","","backup_biblioteca");

if(!$con){
    echo 'Erro ao conectar ao banco'. mysqli_connect_error();
    exit;
}

?>