<?php
	include 'conexao.php';

	$id = 0;
	if(isset($_GET['id'])){

    havePermission($conn, 'etapa', 'etapa_editar');

		$id = (int) $_GET['id'];

		if(isset($_POST['nome'])){
      $nome = addslashes($_POST['nome']);
      $ordem = $_POST['ordem'];
      $status = "0";
      if(isset($_POST['status'])){
        $status = "1";
      }
      $ultima = null;
      if(isset($_POST['ultima'])){
        $ultima = $_POST['ultima'];
      }

      $inicial = null;
      if(isset($_POST['inicial'])){
        $inicial = $_POST['inicial'];
      }

      $final = null;
      if(isset($_POST['final'])){
        $final = $_POST['final'];
      }
      
			$sql = "UPDATE Etapa SET ordem='{$ordem}',nome='{$nome}',
                                 status='{$status}', ultima='{$ultima}', inicial='{$inicial}', final='{$final}'
                                 WHERE empresa = '{$_SESSION["empresa"]}' AND codigo=$id";
      $sucesso = mysqli_query($conn, $sql);

      header('Location: etapas.php');

		}

		$consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND codigo ='{$id}'";
		$result = mysqli_query($conn, $consulta);
		$row = mysqli_fetch_assoc($result);

	} else if(isset($_POST['nome'])){
    
    $nome = addslashes($_POST['nome']);
    $ordem = $_POST['ordem'];

    $status = "0";
    if(isset($_POST['status'])){
      $status = "1";
    }

    $ultima = null;
    if(isset($_POST['ultima'])){
      $ultima = $_POST['ultima'];
    }

    $inicial = null;
    if(isset($_POST['inicial'])){
      $inicial = $_POST['inicial'];
    }

    $final = null;
    if(isset($_POST['final'])){
      $final = $_POST['final'];
    }

		$sql = "INSERT INTO Etapa (ordem, nome, status, ultima, inicial, final, empresa)
						VALUES ('{$ordem}', '{$nome}', '{$status}', '{$ultima}', '{$inicial}', '{$final}', '{$_SESSION["empresa"]}')";
    $sucesso = mysqli_query($conn, $sql);
    
    header('Location: etapas.php');

	} else {
    havePermission($conn, 'etapa', 'etapa_cadastrar');
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
        <a href="#" class="simple-text logo-normal">
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
            <a class="navbar-brand" href="#pablo">Etapas</a>
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
                  <h4 class="card-title">Cadastrar Etapa</h4>
                  <p class="card-category">Informe os dados da etapa para as tarefas!</p>
                </div>
                <div class="card-body">
                  <form action="#" method="post">

                  <!-- Confirmação de Entrega -->

                  <?php
                    if($id == 0){
                      $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' ORDER BY codigo DESC LIMIT 1";
                      $resultOrdem = mysqli_query($conn, $consulta);
                      $rowOrdem = mysqli_fetch_assoc($resultOrdem);
                      $ordem = ((int)$rowOrdem["ordem"]) + 1;
                    }
                  ?>

                  <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Ordem</label>
                          <input type="number" name="ordem" value="<?php echo ($id>0) ? $row['ordem'] : $ordem ?>" class="form-control" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome</label>
                          <input type="text" name="nome" value="<?php echo ($id>0) ? $row['nome'] : "" ?>" class="form-control" required>
                        </div>
                      </div>
                    </div>

                    <?php if($id>0) { ?>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Status</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" name="status" value="1" <?php echo ($id>0 && $row['status'] == '1') ? 'checked' : "" ?>> Ativar</label>
                            </div>
                            <div class="checkbox" data-toggle="tooltip" data-placement="top" title="Ao selecionar como inícial, ele ficará disponível para seus clientes acessar o rastreio.">
                              <label><input type="checkbox" name="inicial" value="1" <?php echo ($id>0 && $row['inicial'] == '1') ? 'checked' : "" ?>> Inícial</label>
                            </div>
                            <div class="checkbox" data-toggle="tooltip" data-placement="top" title="Ao selecionar como final, ele ficará disponível para seus clientes até esta etapa no rastreio.">
                              <label><input type="checkbox" name="final" value="1" <?php echo ($id>0 && $row['final'] == '1') ? 'checked' : "" ?>> Final</label>
                            </div>
                            <?php if($row['ultima'] != '1') { ?>
                            <div class="checkbox" data-toggle="tooltip" data-placement="top" title="Ao selecionar como última, ele ficará para concluir o cronograma.">
                              <label><input type="checkbox" name="ultima" value="1" <?php echo ($id>0 && $row['ultima'] == '1') ? 'checked' : "" ?>> Última</label>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                      </div>
                    </div>

                    <?php } else { ?>
                      <input type="hidden" name="status" value="<?php echo $row['status']; ?>">
                    <?php } ?>
                    
                    <?php if ($id>0) { ?>
                      <button type="submit" class="btn btn-primary pull-right">Atualizar</button>
                    <?php } else { ?>
                      <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                    <?php } ?>
                    
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
  <script>
    $('[data-toggle="tooltip"]').tooltip();
  </script>
</body>

</html>
