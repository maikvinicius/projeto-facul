<?php
  include 'conexao.php';

  $consulta = "SELECT sum(valor) as janeiro, fevereiro.total as fevereiro, marco.total as marco, abril.total as abril, maio.total as maio, junho.total as junho,
                julho.total as julho, agosto.total as agosto, setembro.total as setembro, outubro.total as outubro, novembro.total as novembro, dezembro.total as dezembro
                FROM Venda as V, 
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '2' AND MONTH(data_final) = '2' AND empresa = '{$_SESSION["empresa"]}') as fevereiro,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '3' AND MONTH(data_final) = '3' AND empresa = '{$_SESSION["empresa"]}') as marco,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '4' AND MONTH(data_final) = '4' AND empresa = '{$_SESSION["empresa"]}') as abril,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '5' AND MONTH(data_final) = '5' AND empresa = '{$_SESSION["empresa"]}') as maio,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '6' AND MONTH(data_final) = '6' AND empresa = '{$_SESSION["empresa"]}') as junho,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '7' AND MONTH(data_final) = '7' AND empresa = '{$_SESSION["empresa"]}') as julho,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '8' AND MONTH(data_final) = '8' AND empresa = '{$_SESSION["empresa"]}') as agosto,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '9' AND MONTH(data_final) = '9' AND empresa = '{$_SESSION["empresa"]}') as setembro,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '10' AND MONTH(data_final) = '10' AND empresa = '{$_SESSION["empresa"]}') as outubro,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '11' AND MONTH(data_final) = '11' AND empresa = '{$_SESSION["empresa"]}') as novembro,
                (SELECT sum(valor) as total FROM Venda WHERE MONTH(data_inicial) = '12' AND MONTH(data_final) = '12' AND empresa = '{$_SESSION["empresa"]}') as dezembro
                WHERE MONTH(V.data_inicial) = '1' AND MONTH(V.data_final) = '1' AND V.empresa = '{$_SESSION["empresa"]}';";
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
                <div class="card-header card-header-primary" style="display:flex;justify-content: space-between;">
                  <div>
                    <h4 class="card-title ">Relatórios</h4>
                      <p class="card-category"> Todos os seus relatórios</p>
                  </div>
                  <style>
                  .box-imprimir{
                    display:flex;flex-direction:column;align-items:center;margin-right: 10px;
                  }
                  .box-imprimir:hover{
                    cursor: pointer;
                    opacity: 0.5;
                  }
                  </style>
                    <div class="box-imprimir" onclick="javascript:window.print();">
                      <i class="material-icons">print</i>
                      Imprimir
                    </div>
                </div>
                <div class="card-body">

                  <div class="col-md-12">

                    <table class="table">
                      <thead>
                        <th>Janeiro</th>
                        <th>Fevereiro</th>
                        <th>Março</th>
                        <th>Abril</th>
                        <th>Maio</th>
                        <th>Junho</th>
                        <th>Julho</th>
                        <th>Agosto</th>
                        <th>Setembro</th>
                        <th>Outubro</th>
                        <th>Novembro</th>
                        <th>Dezembro</th>
                      </thead>
                      <tbody>
                          <?php
                            if (mysqli_num_rows($result) > 0) {
                              while($row = mysqli_fetch_assoc($result)) {
                          ?>
                            <tr>
                              <td>R$ <?php echo number_format($row['janeiro'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['fevereiro'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['marco'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['abril'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['maio'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['junho'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['julho'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['agosto'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['setembro'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['outubro'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['novembro'], 2, ',', '.'); ?></td>
                              <td>R$ <?php echo number_format($row['dezembro'], 2, ',', '.'); ?></td>
                            </tr>
                          <?php }}  ?>
                      </tbody>
                    </table>

                  </div>

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
</body>

</html>
