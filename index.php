<?php
include 'conexaoGeral.php';

$_SESSION["logado"] = false;
$error = false;

if(isset($_POST['login']) && isset($_POST['senha'])) {

    $usuario = addslashes($_POST['login']);
    $senha = addslashes($_POST['senha']);

    $consulta = "SELECT * FROM Usuario WHERE login = '{$usuario}' AND senha ='{$senha}' AND status = '1'";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);

    if($row){
        $_SESSION["logado"] = true;
        $_SESSION["codigo"] = $row['codigo'];
        $_SESSION["empresa"] = $row['empresa'];
        header('Location: dashboard.php');
    }else{
        $error = true;
    }

}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Facilita - CRM
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body>
  
  <div class="container">

  <?php if($error){ ?>

  <div class="alert alert-danger" style="margin-top:50px;">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <i class="material-icons">close</i>
    </button>
    <span>
      <b> Aviso - </b> Usuário ou Senha inválidos!</span>
  </div>

  <?php } ?>

  <form action="#" method="post">

    <div class="form-group"  style="margin-top:50px;">
        <label>Login</label>
        <input type="text" name="login" class="form-control">
      </div>

      <div class="form-group">
        <label>Senha</label>
        <input type="password" name="senha" class="form-control">
      </div>

      <div class="form-group" style="display:flex;justify-content:center;">
        <button type="submit" class="btn btn-primary">Logar</button>
        &nbsp;&nbsp;
        <a href="cadastro.php">
          <button type="button" class="btn btn-primary">Cadastrar</button>
        </a>
      </div>

  </form>

  <div class="form-group" style="text-align:center;">
      <a href="esqueci.php">
        <label style="font-size:20px;">Esqueci minha senha</label>
      </a>
    </div>

    

  </div>

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>

</body>

</html>
