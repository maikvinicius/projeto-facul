<?php
	include 'conexao.php';

  $consulta = "SELECT * FROM Venda WHERE empresa = '{$_SESSION["empresa"]}' ORDER BY codigo DESC;";
  $result = mysqli_query($conn, $consulta);

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
  <link href="assets/rastreio/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="assets/rastreio/bootstrap.min.js"></script>
    <script src="assets/rastreio/jquery-1.11.1.min.js"></script>
</head>
<style>

img
{
	vertical-align: middle;
}
.img-responsive
{
	display: block;
	height: auto;
	max-width: 100%;
}
.img-rounded
{
	border-radius: 3px;
}
.img-thumbnail
{
	background-color: #fff;
	border: 1px solid #ededf0;
	border-radius: 3px;
	display: inline-block;
	height: auto;
	line-height: 1.428571429;
	max-width: 100%;
	moz-transition: all .2s ease-in-out;
	o-transition: all .2s ease-in-out;
	padding: 2px;
	transition: all .2s ease-in-out;
	webkit-transition: all .2s ease-in-out;
}
.img-circle
{
	border-radius: 50%;
}
.timeline-centered {
    position: relative;
    margin-bottom: 30px;
}

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before, .timeline-centered:after {
        content: " ";
        display: table;
    }

    .timeline-centered:after {
        clear: both;
    }

    .timeline-centered:before {
        content: '';
        position: absolute;
        display: block;
        width: 4px;
        background: #f5f5f6;
        left: 50%;
        top: 20px;
        bottom: 20px;
        margin-left: -4px;
    }

    .timeline-centered .timeline-entry {
        position: relative;
        width: 50%;
        float: right;
        margin-bottom: 70px;
        clear: both;
    }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry:before, .timeline-centered .timeline-entry:after {
            content: " ";
            display: table;
        }

        .timeline-centered .timeline-entry:after {
            clear: both;
        }

        .timeline-centered .timeline-entry.begin {
            margin-bottom: 0;
        }

        .timeline-centered .timeline-entry.left-aligned {
            float: left;
        }

            .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner {
                margin-left: 0;
                margin-right: -18px;
            }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-time {
                    left: auto;
                    right: -100px;
                    text-align: left;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-icon {
                    float: right;
                }

                .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label {
                    margin-left: 0;
                    margin-right: 70px;
                }

                    .timeline-centered .timeline-entry.left-aligned .timeline-entry-inner .timeline-label:after {
                        left: auto;
                        right: 0;
                        margin-left: 0;
                        margin-right: -9px;
                        -moz-transform: rotate(180deg);
                        -o-transform: rotate(180deg);
                        -webkit-transform: rotate(180deg);
                        -ms-transform: rotate(180deg);
                        transform: rotate(180deg);
                    }

        .timeline-centered .timeline-entry .timeline-entry-inner {
            position: relative;
            margin-left: -22px;
        }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:before, .timeline-centered .timeline-entry .timeline-entry-inner:after {
                content: " ";
                display: table;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner:after {
                clear: both;
            }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time {
                position: absolute;
                left: -100px;
                text-align: right;
                padding: 10px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span {
                    display: block;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:first-child {
                        font-size: 15px;
                        font-weight: bold;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-time > span:last-child {
                        font-size: 12px;
                    }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon {
                background: #fff;
                color: #737881;
                display: block;
                width: 40px;
                height: 40px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 20px;
                -moz-border-radius: 20px;
                border-radius: 20px;
                text-align: center;
                -moz-box-shadow: 0 0 0 5px #f5f5f6;
                -webkit-box-shadow: 0 0 0 5px #f5f5f6;
                box-shadow: 0 0 0 5px #f5f5f6;
                line-height: 40px;
                font-size: 15px;
                float: left;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-primary {
                    background-color: #303641;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-secondary {
                    background-color: #ee4749;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-success {
                    background-color: #00a651;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-info {
                    background-color: #21a9e1;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-warning {
                    background-color: #fad839;
                    color: #fff;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-icon.bg-danger {
                    background-color: #cc2424;
                    color: #fff;
                }

            .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label {
                position: relative;
                background: #f5f5f6;
                padding: 1.7em;
                margin-left: 70px;
                -webkit-background-clip: padding-box;
                -moz-background-clip: padding;
                background-clip: padding-box;
                -webkit-border-radius: 3px;
                -moz-border-radius: 3px;
                border-radius: 3px;
            }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label:after {
                    content: '';
                    display: block;
                    position: absolute;
                    width: 0;
                    height: 0;
                    border-style: solid;
                    border-width: 9px 9px 9px 0;
                    border-color: transparent #f5f5f6 transparent transparent;
                    left: 0;
                    top: 10px;
                    margin-left: -9px;
                }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2, .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p {
                    color: #737881;
                    font-family: "Noto Sans",sans-serif;
                    font-size: 12px;
                    margin: 0;
                    line-height: 1.428571429;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label p + p {
                        margin-top: 15px;
                    }

                .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 a {
                        color: #303641;
                    }

                    .timeline-centered .timeline-entry .timeline-entry-inner .timeline-label h2 span {
                        -webkit-opacity: .6;
                        -moz-opacity: .6;
                        opacity: .6;
                        -ms-filter: alpha(opacity=60);
                        filter: alpha(opacity=60);
                    }

                    iframe {
                      width: 100% !important;
                      height: 300px !important;
                    }

</style>
<body class="">

<header>
  <div class="navbar navbar-dark bg-dark shadow-sm" style="background: linear-gradient(60deg, #00bcd4, #088898);box-shadow:0 4px 20px 0px rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(0, 188, 212, 0.4);">
    <div class="container d-flex justify-content-between">
      <div class="navbar-brand d-flex align-items-center">
      <style>
      a:hover {
          text-decoration: none;
      }
      </style>
      <a href="rastreio.php">
        <div style="text-transform: uppercase;
    padding: 5px 0px;
    display: inline-block;
    font-size: 18px;
    color: #FFF;
    white-space: nowrap;
    font-weight: 400;
    line-height: 30px;
    overflow: hidden;
    text-align: center;
    display: block;">FACILITA - Rastreio</div></a>
      </div>
    </div>
  </div>
</header>

<div class="container" style="padding-top:20px;">
	<div class="row">

  <?php if(!isset($_GET['token'])){ ?>

  <div style="width:100%">
  <?php if(isset($_GET['error'])){ ?>

<div class="alert alert-danger" style="margin-bottom:50px;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <i class="material-icons">X</i>
  </button>
  <span>
    <b> Aviso - </b> Token inválido!</span>
</div>

<?php } ?>
  <form action="" method="GET">
      <div class="form-group">
        <label>Token</label>
        <input type="text" name="token" placeholder="Cole o token" class="form-control" required>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-primary">Acessar rastreio</button>
      </div>
  </form>
  </div>

  <?php } else { 

    $token = addslashes($_GET['token']);

    $consulta = "SELECT * FROM Venda WHERE empresa = '{$_SESSION["empresa"]}' AND token = '{$token}'";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);

    if(!$row){
      echo "<script> document.location.href='rastreio.php?error';</script>";
    }

    $consulta = "
    SELECT * FROM Item_Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND FK_Venda_Codigo = '{$row['codigo']}' 
    AND FK_Etapa_Codigo in (
        SELECT codigo FROM Etapa 
        WHERE ordem >= (SELECT ordem FROM Etapa WHERE inicial = '1' LIMIT 1) AND 
        ordem <= (SELECT ordem FROM Etapa WHERE final = '1' LIMIT 1)
    ) 
   ORDER BY codigo ASC;";
    $result = mysqli_query($conn, $consulta);
    ?>


		<div class="timeline-centered">

    <?php
    $i=0;
                      if (mysqli_num_rows($result) > 0) {
                          while($item = mysqli_fetch_assoc($result)) {
                              $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$item['FK_Etapa_Codigo']}'";
                              $resultEtapa = mysqli_query($conn, $consulta);
                              $etapa = mysqli_fetch_assoc($resultEtapa);
                      ?>

<article class="timeline-entry <?php echo ($i%2 == 0) ? 'left-aligned' : '';?>">
		
		<div class="timeline-entry-inner">
        <time class="timeline-time"><span><?php echo date("d/m/Y", strtotime($item['data_inicial']));?></span> <span><?php echo date("H:i", strtotime($item['data_inicial']));?></span></time>
			
			<div class="timeline-icon bg-info" style="background-color:#01b9d1;">
				<i class="<?php echo ($i%2 == 0) ? 'entypo-suitcase' : 'entypo-feather';?>"></i>
			</div>
			
			<div class="timeline-label">
                <h2><?php echo $etapa['nome'];?></h2>
				<?php echo $item['descricao'];?>
			</div>
		</div>
		
	</article>
  
  <?php $i++; } } ?>
	
  <article class="timeline-entry begin">
	
  <div class="timeline-entry-inner">
    
    <div class="timeline-icon" style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);">
      <i class="entypo-flight"></i>
    </div>
    
  </div>
  
</article>
	
</div>

        <?php } ?>

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
