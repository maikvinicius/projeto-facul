<?php
include 'conexaoGeral.php';

$_SESSION["logado"] = false;

if(isset($_POST['email'])) {

    $email = addslashes($_POST['email']);

    $consulta = "SELECT * FROM Usuario WHERE email = '{$email}' AND status = '1'";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);

    if($row){
        $alerta = "Encaminhamos para seu email!";
    } else{
       $alerta = "Email inválido!";
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

    <?php if($alerta){ ?>

    <div class="alert alert-primary" style="background-color:#00bcd4;box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 1);margin-top:50px;">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <i class="material-icons">close</i>
      </button>
      <span>
        <b> Aviso - </b> <?php echo $alerta; ?></span>
    </div>

    <?php } ?>

    <form action="#" method="post">

      <div class="col-md-12" style="margin-top:30px;">
        <div class="form-group">
          <label>Digite seu E-mail</label>
          <input type="email" name="email" class="form-control" required>
        </div>
      </div>

      <div class="form-group" align="center">
        <button type="submit" class="btn btn-primary">Enviar</button>
      </div>

    </form>

  </div>

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>

</body>

</html>
