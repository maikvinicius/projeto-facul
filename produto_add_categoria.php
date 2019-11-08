<?php
	include 'conexao.php';

	$id = 0;
	if(isset($_GET['id'])){

    $id = (int) $_GET['id'];

    if(isset($_POST['TotalNovas'])){
      $quantidade = (int) $_POST['TotalNovas'];

      if($quantidade > 0){
        for ($i=1; $i <= $quantidade; $i++) { 
          $categoria = $_POST['categoria'.$i];
          $sql = "INSERT INTO Item_Cat_Produto (FK_Categoria_Produto_codigo, FK_Produto_codigo, empresa)
              VALUES ('{$categoria}', '{$id}', '{$_SESSION["empresa"]}')";
          $sucesso = mysqli_query($conn, $sql);
        }
      }

      header('Location: categorias_produtos_view.php?id='.$id);
    }

    $consulta = "SELECT * FROM Produto WHERE empresa = '{$_SESSION["empresa"]}' AND codigo ='{$id}'";
		$result = mysqli_query($conn, $consulta);
		$row = mysqli_fetch_assoc($result);

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

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
          Facilita
        </a>
      </div>
      <div class="sidebar-wrapper">
        <?php include 'menu.php'; ?>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo">Produtos</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <?php include 'notificacoes.php'; ?>
              <?php include 'mini_painel.php'; ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Cadastrar categoria para seu produto</h4>
                  <p class="card-category">Adicione as categorias!</p>
                </div>
                <div class="card-body">
                  <form action="#" method="post">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome</label>
                          <input disabled type="text" name="nome" value="<?php echo ($id>0) ? $row['nome'] : "" ?>" class="form-control">
                        </div>
                      </div>
                    </div>

                    <div id="novasRespostas"></div>
                    <input type="hidden" name="TotalNovas" id="TotalNovas" value="0">
                    <div class="row">
                      <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="novaResposta()">Adicionar categoria</button>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                    
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  </select>
  <script>
  function novaResposta(){

    var total = parseInt($("#TotalNovas").val());
    total = total + 1;
    var html = '';

    html += '<div class="row">';
    html += '<div class="col-md-12">';
    html += '<div class="form-group">';
    html += '<select name="categoria'+total+'" class="form-control">';

    <?php
    $consulta = "SELECT * FROM Categoria_Produto WHERE empresa = '{$_SESSION["empresa"]}' AND status='1';";
    $result = mysqli_query($conn, $consulta);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) { ?>
    html += '<option value="<?php echo $row['codigo']; ?>"><?php echo $row['nome']; ?></option>';
      <?php }} ?>
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '</div>';
    html += '<div style="clear:both;"></div>';

    $("#novasRespostas").append(html);
    $("#TotalNovas").val(total);

  }
  </script>
  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="assets/js/plugins/arrive.min.js"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script src="assets/js/global.js"></script>
</body>

</html>
