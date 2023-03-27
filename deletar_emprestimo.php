<?php
include_once('conexao.php');

// Condiçãob para alterar a data de devolução
if (isset($_GET['id_opcao'])) {
  $id_opcao = $_GET['id_opcao'];

  //Altera a data de devolução para a data em que o livro foi devolvido para ser impresso no PDF de devolução
  $sql_data = "UPDATE emprestimo SET data_f = NOW() WHERE id_opcao = $id_opcao";
  $resp_query_data = mysqli_query($_SESSION['conexao'], $sql_data);
}

use Dompdf\Dompdf;

//carregar o compose
require './dompdf/vendor/autoload.php';

$dompdf = new Dompdf();

// Seleciona os dados da tabela empréstimo e os ordena do maior id até o menor pegando o ultimo valor para ser impresso no PDF
$sql = "SELECT * FROM emprestimo ORDER BY id_opcao DESC LIMIT 1";
$result = $_SESSION['conexao']->query($sql);

$sql_img = "SELECT * FROM logo";
$resp = $_SESSION['conexao']->query($sql_img);


//Vai pegar os dados e coloca nas variaveis
while ($row = mysqli_fetch_assoc($result)) {
  $nome_aluno = $row['nome_aluno'];
  $num_id = $row['num_id'];
  $email = $row['email'];
  $nome_livro = $row['nome_livro'];
  $nome_livro2 = $row['nome_livro2'];
  $nome_livro3 = $row['nome_livro3'];
  $spn = $row['cod_spn'];
  $spn2 = $row['cod_spn2'];
  $spn3 = $row['cod_spn3'];
  $data_emissao = date('d-m-Y', strtotime($row['data_e']));
  $devolucao = date('d-m-Y', strtotime($row['data_f']));
}

//Pega a imagem do banco para colocar no PDF
while ($linha = mysqli_fetch_assoc($resp)) {

  $imagem = $linha['arquivo_img'];
}

$html = '<head>
 <meta charset="UTF-8">
 <title>Comprovante</title>
</head>';

$html = '<head>
<meta charset="UTF-8">
<title>Comprovante</title>
</head>';

$html .= '<body>
<br><br><br><br>
<header class="clearfix">
<div id="logo">
<img class="img-xs rounded-circle" src="data:image/png;base64,' . base64_encode($imagem) . '" alt="Imagem de perfil">
</div>
    <div id="company">
      <h2 class="name">SENAI</h2>
      <div>Nome da rua</div>
      <div>(99)9 9999-9999</div>
      <div>email@example.com</div>
    </div>
  
  </header>
  <h1 style="color: #005baa;">Comprovante de Devolução</h1>
  <br><br><br><br>
  <main>
    <div id="details" class="clearfix">
      <div id="client">
        <div class="to">Fatura para:</div>
        <h2 class="name">' . $nome_aluno . '</h2>
        <div class="email">' . $email . '</div>
        <div class="email">' . $num_id . '</div>
        <div class="email">' . $nome_livro . '</div>
        <div class="email">' . $nome_livro2 . '</div>
        <div class="email">' . $nome_livro3 . '</div>
      </div>
      <br>
    <div id="invoice">
        <div class="date">Data de Empréstimo: ' . $data_emissao . '</div>
        <div class="date">Data de Devolução: ' . $devolucao . '</div>
      </div>
    </div>
  </main></body>';


$html .= "<style> 
.clearfix:after {
  content: '';
  display: table;
  clear: both;
}

a {
  color: #0087C3;
  text-decoration: none;
}

body {
  
  position: relative;
  width: 100%;  
  height: 100%; 
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
  border-bottom: 2px solid #005baa;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #005baa;
  float: left;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}

#invoice {
  float: right;
  text-align: right;
}

#invoice h1 {
  color: #005baa;
  font-size: 2.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}

</style>";
// Agora você pode usar o HTML gerado para gerar o PDF:

$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'landscape');
$dompdf->render();
$dompdf->stream('Emprestimo', array('Attachment' => 0));
$dompdf->output();

//---------------------------------------------------------------------------------------
include_once('include/header.php');

if (isset($_GET['id_opcao'])) {
  $id_opcao = $_GET['id_opcao'];
  $cod_spn = $_GET['cod_spn'];
  $cod_spn2 = $_GET['cod_spn2'];
  $cod_spn3 = $_GET['cod_spn3'];

  //Realiza uma atualização do status do empréstimo para zero o tornando "deletado" nos registros
  $sql = "DELETE FROM emprestimo WHERE id_opcao = $id_opcao";
  $resp_query = mysqli_query($_SESSION['conexao'], $sql);

  if ($resp_query) {

    //Realiza um update no status na tabela cad_livro tornando o livro disponivel na lista principal
    $sql = "UPDATE cad_livro SET status = 1 WHERE cod_spn = $cod_spn";
    $resp_query = mysqli_query($_SESSION['conexao'], $sql);

    //Realiza um update no status na tabela cad_livro tornando o livro disponivel na lista principal
    $sql2 = "UPDATE cad_livro SET status = 1 WHERE cod_spn = $cod_spn2";
    $resp_query2 = mysqli_query($_SESSION['conexao'], $sql2);

    //Realiza um update no status na tabela cad_livro tornando o livro disponivel na lista principal
    $sql3 = "UPDATE cad_livro SET status = 1 WHERE cod_spn = $cod_spn3";
    $resp_query3 = mysqli_query($_SESSION['conexao'], $sql3);

    echo '<br><center><label class="badge badge-success" style="font-size:medium;">Devolução feito com Sucesso.</label></center><br><br><br><br><br><br><br>';

    echo  '<br><center><button type="button" class="btn btn-social-icon-text btn-twitter"><i class="mdi mdi-arrow-left"></i><a href="lista_emprestados.php">Voltar</a></button></center><br><br><br><br><br><br><br><br><br><br><br><br>';
    // header('Location:lista_emprestados.php'); 
  } else {
    echo '<label class="badge badge-danger">Erro ao deletar o empréstimo</label>';
  }
}



include_once('include/footer.php');


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