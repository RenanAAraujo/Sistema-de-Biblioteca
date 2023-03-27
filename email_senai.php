<?php

include_once 'include/header.php';
// include_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$emaill = $_SESSION['email'];

$sql = "SELECT * FROM cad_login WHERE email = '$emaill'";
$resp = mysqli_query($_SESSION['conexao'], $sql);

while ($linha = mysqli_fetch_array($resp)) {

  $nome = $linha['nome'];
  $email = $linha['email'];

}

        if(isset($_POST['email_contato'])){
        //     if(strlen($_POST['email_inst']) == 0){

        //         echo '<h4 style="color:#000000;font-size: 20px;"> Preencha seu email!</h4>';
        //     }else 


        if(strlen($_POST['email_contato']) == 0){

                echo '<h4 style="color:#000000;font-size: 20px;"> Preencha seu email!</h4>';
            }else{
   


if(empty($data['Enviar'])){

$attachment = $_FILES['attachment'];
// var_dump($attachment);
// $email_inst = $_POST['email_inst'];
$email_contato = $_POST['email_contato'];
$content = $_POST['content'];


require 'email/lib/vendor/autoload.php';

        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '5a36883f01a7d1';
            $mail->Password = '2c78e07384b663';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;

            $mail->setFrom($email, 'Funcionario');
            $mail->addAddress($email_contato);
            
            if(isset($attachment['name']) AND !empty($attachment['name'])){

            $mail->addAttachment($attachment['tmp_name'], $attachment['name']);
      

            }
            $mail->isHTML(true);                                 
            $mail->Subject = 'Titulo do E-mail';
            $mail->Body = $content;
            $mail->AltBody = "Olá, enviando requisição";

            $mail->send();
            
            echo '<br><center><label class="badge badge-success" style="font-size:medium;">Comprovante enviado com sucesso!</label></center>';
        } catch (Exception $e) {
            echo '<br><center><label class="badge badge-danger" style="font-size:medium;"> Erro ao enviar comprovante!</label></center>. Error PHPMailer: {$mail->ErrorInfo}';
            //echo "Erro: E-mail não enviado com sucesso.<br>";
        }
    }
}
        }

        
        ?>
   
   <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Biblioteca SENAI </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<div class="tab-content tab-content-basic">



  <br>
  <center>
    <h3 class="welcome-text" style="color: #a8b3ab;">Comunicação com  <span class="text-primary fw-bold">a supervisão</span></h3>
  </center>
  <div class="col-md-10 grid-margin stretch-card" style="margin: 0 auto;">
    <div class="card">
      <div class="card-body">

        <form class="forms-sample" action="email_senai.php" method="post" enctype="multipart/form-data">

          <div class="form-group">
            <label>Email para contato</label>
            <input type="email" class="form-control" name="email_contato" placeholder="Email do admistrador">
          </div>

          <div class="form-group">
            <label>Conteúdo</label>
            <input type="text" class="form-control" name="content" id="content" placeholder="Conteúdo" value="<?php 
            
            if(isset($data['content'])){
              echo $data['content'];
            }

            ?>">
          </div>

          <div class="form-group">
            <label>Anexo do Comprovante</label>
            <input type="file" class="form-control" name="attachment" placeholder="Anexo" id="attachment">
          </div>

          <center> <button type="submit" name="Enviar" class="btn btn-primary me-2" value="Enviar">Enviar</button></center>
        </form>
      </div>
    </div>
  </div>
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

  <br>

  <?php
  include_once 'include/footer.php';
?>