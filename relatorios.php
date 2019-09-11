<?php
	include 'conexao.php';

	// if(isset($_GET['produto']) && isset($_GET['quantidade'])){
	// 	$id = (int) $_GET['produto'];
	// 	if($id>0){
	// 		$quantidade = (int) $_GET['quantidade'] + (int) $_GET['total'];
	// 		$sql = "UPDATE servico SET quantidade='{$quantidade}' WHERE codigo=$id";
	// 		$sucesso = mysqli_query($conn, $sql);

	// 		if($sucesso){
	// 			$codigoLogado = $_SESSION["codigo"];
	// 			$quantidade = $_GET["quantidade"];
	// 			$sql = "INSERT INTO acao (usuario, acao, produto)
	// 							VALUES ('{$codigoLogado}', 'Atualizou produto, quantidade: {$quantidade}', '{$id}')";
	// 			$sucesso = mysqli_query($conn, $sql);
	// 		}

	// 	}else{
	// 		$sucesso = false;
	// 	}
	// }

	$consulta = "SELECT * FROM Venda ORDER BY codigo DESC;";
  $result = mysqli_query($conn, $consulta);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    FACILITA
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/js/chart/Chart.min.css">
  <script src="assets/js/chart/Chart.bundle.min.js"></script>
  <script src="assets/js/chart/Chart.min.js"></script>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          FACILITA
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
            <a class="navbar-brand" href="#pablo">Relatórios</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
            <li class="nav-item">
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
                  <h4 class="card-title ">Relatórios</h4>
                  <p class="card-category"> Todos os seus relatórios</p>
                </div>
                <div class="card-body">

                <style>
                .box-relatorios{
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  flex-direction: row;
                  flex-wrap: wrap;
                }
                .box-relatorios a {
                  display: flex;
                  justify-content: center;
                  align-items: center;
                  flex-direction: column;
                  width: 100%;
                  max-width: 300px;
                  height: 200px;
                  background: #eee;
                  margin: 10px;
                  border-radius: 30px;
                }
                .box-relatorios a:hover {
                  opacity: 0.5;
                }
                .box-relatorios a .icon{
                  color: #0793a5;
                  text-align: center;
                }
                .box-relatorios a .title{
                  font-size: 16px;
                  text-align: center;
                }
                </style>

                    <div class="box-relatorios">

                    <a href="relatorio.php?relatorio=barra">
                        <div class="box-relatorio">
                            <div class="icon">
                                <i class="material-icons">filter_list</i>
                              </div>
                              <div class="title">
                                Ticket médio
                              </div>
                          </div>
                    </a>

                    <a href="relatorio.php?relatorio=linha">
                        <div class="box-relatorio">
                        <div class="icon">
                            <i class="material-icons">category</i>
                          </div>
                          <div class="title">
                            Categorias de Clientes
                          </div>
                        </div>
                      </a>

                      <a href="relatorio.php?relatorio=linha">
                        <div class="box-relatorio">
                        <div class="icon">
                            <i class="material-icons">category</i>
                          </div>
                          <div class="title">
                            Categorias de produtos
                          </div>
                        </div>
                      </a>

                      <a href="relatorio.php?relatorio=linha">
                        <div class="box-relatorio">
                        <div class="icon">
                            <i class="material-icons">card_giftcard</i>
                          </div>
                          <div class="title">
                            Produtos
                          </div>
                        </div>
                      </a>

                      <a href="relatorio.php?relatorio=linha">
                        <div class="box-relatorio">
                        <div class="icon">
                            <i class="material-icons">work</i>
                          </div>
                          <div class="title">
                            Projetos
                          </div>
                        </div>
                      </a>

                      <a href="relatorio.php?relatorio=linha">
                      <div class="box-relatorio">
                        <div class="icon">
                          <i class="material-icons">contact_mail</i>
                        </div>
                        <div class="title">
                          Clientes
                        </div>
                      </div>
                      </a>

                    </div>

                </div>
              </div>
            </div>
          </div>
          
            <!-- <nav aria-label="Page navigation example">
              <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                  <a class="page-link" href="#" tabindex="-1">Voltar</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                  <a class="page-link" href="#">Próximo</a>
                </li>
              </ul>
            </nav> -->
          
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
</body>

</html>
