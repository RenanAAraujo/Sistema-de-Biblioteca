<?php

include_once 'include/header.php';

// Conexão com o banco de dados de origem
$dsn = 'mysql:host=localhost;dbname=biblioteca_senai;charset=utf8';
$username = 'root';
$password = '';
$origem = new PDO($dsn, $username, $password);

// Conexão com o banco de dados que irá receber o backup
$dsn_backup = 'mysql:host=localhost;dbname=backup_biblioteca;charset=utf8';
$username_backup = 'root';
$password_backup = '';
$backup = new PDO($dsn_backup, $username_backup, $password_backup);

// Exclui todos os dados das tabelas
$tables = $origem->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
foreach ($tables as $table) {
  $backup->query("DELETE FROM $table");
}

// Obtém lista de tabelas
$tables = $origem->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

foreach ($tables as $table) {
  // Obtém os dados
  $result = $origem->query("SELECT * FROM $table");
  $rows = $result->fetchAll(PDO::FETCH_ASSOC);

  // Insere os dados na tabela de backup
  foreach ($rows as $row) {
    $fields = implode(', ', array_keys($row));
    $values = implode(', ', array_map(function ($value) use ($backup) {
      return $backup->quote($value);
    }, $row));
    $sql = "INSERT INTO $table ($fields) VALUES ($values)";
    $backup->query($sql);
  }
}

echo '<br><center><label class="badge badge-success" style="font-size:medium;">Backup concluído</label></center>';

$origem = null;
$backup = null;


echo ' <center><br><button type="button" class="btn btn-social-icon-text btn-facebook"><i class="mdi mdi-arrow-left"></i><a href="home.php">Voltar</a></button></center>
 <br><br><br><br><br><br><br><br><br><br><br><br>';

require 'include/footer.php';
?>

<style>
  a {
    text-decoration: none;
    color: white;
  }

  a:hover {
    color: white;
  }
</style>