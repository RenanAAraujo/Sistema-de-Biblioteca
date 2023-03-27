<?php
include_once('conexao.php');

if (isset($_POST['email']) != '') {
  if (strlen($_POST['email']) == 0) {

    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Preencha o email!</label></center>';
  } else if (strlen($_POST['senha']) == 0) {

    echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Preencha a senha!</label></center>';
  } else {
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    $sql = "SELECT * FROM cad_login WHERE email = '$email'";
    $resultado = mysqli_query($_SESSION['conexao'], $sql);
    $linha = mysqli_fetch_array($resultado, MYSQLI_ASSOC);

    if (isset($linha['email']) != null) {

      $email_bd = $linha['email'];
      $senha_bd = $linha['senha'];

      if ($email == $email_bd && $senha == $senha_bd) {

        session_start();
        $_SESSION['email'] = $linha['email'];
        $_SESSION['nome'] = $linha['nome'];
        $_SESSION['senha'] = $linha['senha'];

        header('Location:home.php');
      } else {
        echo '<br><center><label class="badge badge-danger" style="font-size:medium;">Senha ou Email incorretos</label></center>';
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/typicons/typicons.css">
  <link rel="stylesheet" href="./vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2997/2997608.png">
</head>
<body style="background-image: url('fundo.jpg'); background-attachment: fixed;background-repeat: no-repeat;">

  <br><br><br><br><br>
  <div class="container">

    <div class="slide-in-top">
      <div class="col-md-4 grid-margin stretch-card" style="margin: 0 auto;">
        <div class="card">
          <div class="card-body">

            <div class="auth-form text-left py-4 px-2 px-sm-5">
              <div class="brand-logo">
                <img src="logo_senai.png" alt="logo" width="50%">
              </div>
              <br>
              <h4> Seja bem-vindo!</h4>
              <h6 class="fw-light">Faça o login para prosseguir</h6>
              <form class="pt-4" action="adm.php" method="post">
                <div class="form-group">
                  <label>Email:</label>
                  <input type="text" class="form-control form-control-lg" name="email" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <label>Senha:</label>
                  <input type="password" class="form-control form-control-lg" name="senha" id="exampleInputPassword1" placeholder="Senha">
                </div>
                <center><input type="submit" value="Login" class="btn btn-primary btn-rounded btn-fw"></center>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
  </div>
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="./vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
  <!-- endinject -->



</body>

</html>

<style>
  .slide-in-top {
    -webkit-animation: slide-in-top 1.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
    animation: slide-in-top 1.5s cubic-bezier(0.250, 0.460, 0.450, 0.940) both;
  }

  @-webkit-keyframes slide-in-top {
    0% {
      -webkit-transform: translateY(-1000px);
      transform: translateY(-1000px);
      opacity: 0;
    }

    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      opacity: 1;
    }
  }

  @keyframes slide-in-top {
    0% {
      -webkit-transform: translateY(-1000px);
      transform: translateY(-1000px);
      opacity: 0;
    }

    100% {
      -webkit-transform: translateY(0);
      transform: translateY(0);
      opacity: 1;
    }
  }
</style>