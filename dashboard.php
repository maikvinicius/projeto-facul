<?php
	include 'conexao.php';

	$consulta = "SELECT * FROM Venda WHERE empresa = '{$_SESSION["empresa"]}' ORDER BY codigo DESC;";
  $result = mysqli_query($conn, $consulta);

  $consulta = "SELECT * FROM Permissao WHERE FK_Usuario_codigo ='{$_SESSION["codigo"]}';";
  $result = mysqli_query($conn, $consulta);
  $rowPermissao = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

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
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
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
            <a class="navbar-brand" href="#pablo">Dashboard</a>
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
            <?php if(unserialize($rowPermissao['projeto'])['projeto_visualizar'] == 1){ ?>
            <?php

            $consulta = "SELECT segunda.total as segunda, terca.total as terca, quarta.total as quarta, 
                          quinta.total as quinta, sexta.total as sexta
                        FROM 
                          (SELECT count(codigo) as total FROM Venda WHERE DAYOFWEEK(data_final) = 2 AND empresa = '{$_SESSION["empresa"]}') as segunda,
                          (SELECT count(codigo) as total FROM Venda WHERE DAYOFWEEK(data_final) = 3 AND empresa = '{$_SESSION["empresa"]}') as terca,
                          (SELECT count(codigo) as total FROM Venda WHERE DAYOFWEEK(data_final) = 4 AND empresa = '{$_SESSION["empresa"]}') as quarta,
                          (SELECT count(codigo) as total FROM Venda WHERE DAYOFWEEK(data_final) = 5 AND empresa = '{$_SESSION["empresa"]}') as quinta,
                          (SELECT count(codigo) as total FROM Venda WHERE DAYOFWEEK(data_final) = 6 AND empresa = '{$_SESSION["empresa"]}') as sexta;";
                $result = mysqli_query($conn, $consulta);
                $row = mysqli_fetch_assoc($result);
            ?>

            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                  <script>
                  new Chartist.Line('#dailySalesChart', {
                    labels: ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta'],
                    series: [
                      [
                        <?php echo $row['segunda']; ?>, <?php echo $row['terca']; ?>, <?php echo $row['quarta']; ?>,
                        <?php echo $row['quinta']; ?>, <?php echo $row['sexta']; ?>
                      ]
                    ]
                  }, {
                    fullWidth: true,
                    chartPadding: {
                      right: 40
                    }
                  });
                  </script>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Cronograma</h4>
                </div>
              </div>
            </div>
            <?php } ?>
            <?php if(unserialize($rowPermissao['projeto'])['projeto_visualizar'] == 1){ ?>
            <?php

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
                $row = mysqli_fetch_assoc($result);

            ?>

            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                  <script>
                  new Chartist.Bar('#websiteViewsChart', {
                  labels: ['J', 'F', 'M', 'A', 'M', 'J', 'J', 'A', 'S', 'O', 'N', 'D'],
                  series: [
                    [
                      <?php echo $row['janeiro']; ?>, <?php echo $row['fevereiro']; ?>,<?php echo $row['marco']; ?>,<?php echo $row['abril']; ?>,
                      <?php echo $row['maio']; ?>, <?php echo $row['junho']; ?>, <?php echo $row['julho']; ?>, <?php echo $row['agosto']; ?>,
                      <?php echo $row['setembro']; ?>, <?php echo $row['outubro']; ?>, <?php echo $row['novembro']; ?>, <?php echo $row['dezembro']; ?>
                    ]
                  ]
                }, {
                  stackBars: true,
                  axisY: {
                    labelInterpolationFnc: function(value) {
                      return (value / 1000) + 'k';
                    }
                  }
                }).on('draw', function(data) {
                  if(data.type === 'bar') {
                    data.element.attr({
                      style: 'stroke-width: 30px'
                    });
                  }
                });
                  </script>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Projetos</h4>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>
          <?php if(unserialize($rowPermissao['projeto'])['projeto_visualizar'] == 1){ ?>
          <div class="row">
            <div class="col-lg-12 col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Projetos</h4>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                    <thead class="text-primary">
                      <th>Cliente</th>
                      <th>Início</th>
                      <th>Final</th>
                    </thead>
                    <tbody>

                    <?php
                        $consulta = "SELECT * FROM Venda WHERE empresa = '{$_SESSION["empresa"]}' AND status='1' ORDER BY codigo DESC;";
                        $result = mysqli_query($conn, $consulta);
                    ?>
                      <?php
                      if (mysqli_num_rows($result) > 0) {
                          while($row = mysqli_fetch_assoc($result)) {
                      ?>
                      <tr>
                      <td><?php echo $row['nome']; ?></td>
                          <td><?php echo date('d/m/Y', strtotime($row['data_inicial'])); ?></td>
                          <td><?php echo date('d/m/Y', strtotime($row['data_final'])); ?></td>
                      </tr>
                      <?php } }else { ?>
                        <tr>
                          <td colspan="3">Nenhum projeto cadastrado!</td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          <?php } ?>
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
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
</body>

</html>
