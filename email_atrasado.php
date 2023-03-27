<?php
include_once('include/header.php');

include_once('conexao.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$sql="SELECT id_opcao FROM emprestimo WHERE status = 2";
    $roda_sql=mysqli_query($_SESSION['conexao'],$sql);
    $sql_total=mysqli_fetch_array($roda_sql,MYSQLI_ASSOC);

while ($linha = mysqli_fetch_array($resp_sql)) {

    $data = new DateTime($linha['data_f']);
    $dataAtual = new DateTime();
  
    $intervalo = $dataAtual->diff($data);
  
  if ($dataAtual > $data) {
  
$email_aluno = $linha['email'];

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

            $mail->setFrom('senai@gmail.com', 'Atendimento');
            $mail->addAddress($email_aluno);
            
           
            $mail->isHTML(true);                                 
            $mail->Subject = 'Atenção! Devolução atrasada';
     
            $mail->Body = "Olá Aluno, O livro emprestado esta atrasado.";

            $mail->send();
            
            echo '<br><center><label class="badge badge-success" style="font-size:medium;">Comprovante enviado com sucesso!</label></center>';
        } catch (Exception $e) {
            echo '<br><center><label class="badge badge-danger" style="font-size:medium;"> Erro ao enviar comprovante!</label></center>. Error PHPMailer: {$mail->ErrorInfo}';
            //echo "Erro: E-mail não enviado com sucesso.<br>";
        }
    }
}
?> 