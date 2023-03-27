<?php
date_default_timezone_set('America/Sao_Paulo');

include_once 'conexao.php';

if ($_SESSION['email'] == null || $_SESSION['email'] == '') {


  header('Location: adm.php');
}
$emaill = $_SESSION['email'];

$sql = "SELECT * FROM cad_login WHERE email = '$emaill'";
$resp = mysqli_query($_SESSION['conexao'], $sql);

while ($linha = mysqli_fetch_array($resp)) {

  $nome = $linha['nome'];
  $email = $linha['email'];

}

$hora = date('H');

if ($hora > 6 and $hora <= 12) {
  $var = 'Bom dia, ';
} elseif ($hora > 12 and $hora < 18) {
  $var = 'Boa tarde, ';
} else {
  $var = 'Boa noite, ';
}

?>



<!DOCTYPE html>
<html lang="pt-br">

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
  <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2997/2997608.png" />
</head>

<body>

  <!-- partial:partials/_navbar.html -->
  <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <!-- Por o nome em vez da imagem-->
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo" href="home.php">
          <!--Onde vai ficar a logo do senai-->
          <img src="logo_senai.png" alt="logo" />
        </a>
        <a class="navbar-brand brand-logo-mini" href="home.php">
          <img src="logo_senai_mini.png" alt="logo" style="border-radius: 35%;" />
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h1 class="welcome-text"><?php echo $var; ?><span class="text-primary fw-bold"><?php echo $nome; ?></span></h1>
        </li>
      </ul>

      <!--Selecionar a categoria dos livros-->
      <ul class="navbar-nav ms-auto">
      <ul class="navbar-nav ms-auto">
        <form class="search-form" action="buscar.php" id="the-basics">
          <span class="twitter-typeahead" style="position: relative; display: inline-block;top:1.5px;">
            <input type="search" class="form-control" placeholder="Pesquise Aqui" title="Pesquise Aqui" name="pesquisar" value="<?php if (isset($_GET['pesquisar'])) echo $_GET['pesquisar']; ?>" style="border-radius:15px;">
          </span>
          <button type="submit" style="margin-bottom: 2px;" class="btn btn-primary btn-sm"><i class="icon-search" style="margin-top: -2px;"></i></button>
        </form>

        </li>
        <!--final do selecionador -->

        <li class="nav-item d-none d-lg-block">
          <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
              <span class="icon-calendar input-group-text calendar-icon"></span>
            </span>
            <input type="text" class="form-control">
          </div>
        </li>
      
      


          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
              <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="images/perfil/d3.png" alt="Imagem de perfil"></a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                <img class="img-md rounded-circle" src="images/perfil/d3.png" width="40px" height="40px" style=" object-fit: cover;" alt="Imagem de Perfil">
                  <p class="mb-1 mt-3 font-weight-semibold"><?php echo $nome; ?></p>
                  <p class="fw-light text-muted mb-0"><?php echo $email; ?></p>
                </div>
                <a href="email_senai.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i>Contato Instituição</a>
  
                <a class="dropdown-item" href="faq.php"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a>
                <a class="dropdown-item" href="logout.php?logout='sair'"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Logout</a>
              </div>
            </li>
        

        

      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->
  <div class="container-fluid page-body-wrapper ">


    <!-- partial -->
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item active">
          <a class="nav-link" href="home.php">
            <i class="mdi mdi-grid-large menu-icon mdi mdi-home"></i>
            <span class="menu-title">Início</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false">
            <i class="menu-icon mdi mdi-content-paste"></i>
            <span class="menu-title">Cadastro</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="form-elements">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="cad_livro.php">Cadastro de Livros</a></li>
              <li class="nav-item"><a class="nav-link" href="cad_usu.php"> Cadastro de Alunos</a></li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false">
            <i class="menu-icon mdi mdi-card-text-outline"></i>
            <span class="menu-title">Sessão</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="emprestimo.php">Realizar Empréstimo</a></li>
              <li class="nav-item"><a class="nav-link" href="./dompdf/gerar_emprestimos.php">Gerar PDF</a></li>
              <li class="nav-item"><a class="nav-link" href="email.php">Enviar Comprovante</a></li>
            </ul>
          </div>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#table" aria-expanded="false" aria-controls="icons">
            <i class="menu-icon mdi mdi mdi-book-multiple"></i>
            <span class="menu-title">Listas</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="table">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="lista_usu.php">Lista de Alunos</a></li>
              <li class="nav-item"><a class="nav-link" href="lista_emprestados.php">Livro Emprestados</a></li>
            </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-bs-toggle="collapse" href="#tabless" aria-expanded="false">
            <i class="menu-icon mdi mdi-border-color"></i>
            <span class="menu-title">Relatório</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="tabless">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"><a class="nav-link" href="relatorio.php">Relatório</a></li>
              <li class="nav-item"><a class="nav-link" href="relatorioSemanal.php">Relatório de Gerenciamento </a></li>

            </ul>
          </div>
        </li>

        <li class="nav-item nav-category">Backup</li>
        <li class="nav-item">
          <a class="nav-link" href="backup.php">
            <i class="menu-icon mdi mdi-backup-restore"></i>
            <span class="menu-title">Fazer backup</span>
          </a>
        </li>

        <li class="nav-item nav-category">Logout</li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php?logout='sair'">
            <i class="menu-icon mdi mdi-logout"></i>
            <span class="menu-title">Logout</span>
          </a>
        </li>


        <li class="nav-item nav-category">Ajuda</li>
        <li class="nav-item">
          <a class="nav-link" href="#">
            <i class="menu-icon mdi mdi-phone"></i>
            <span class="menu-title">Tel: (xx) 9 XXXX - XXXX</span>
          </a>
        </li>
      </ul>
    </nav>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-sm-12">