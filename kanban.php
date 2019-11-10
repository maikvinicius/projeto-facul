<?php
	include 'conexao.php';

	$consulta = "SELECT * FROM Usuario WHERE empresa = '{$_SESSION["empresa"]}';";
  $result = mysqli_query($conn, $consulta);

  havePermission($conn, 'cronograma', 'cronograma_visualizar');

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
  <link rel='stylesheet' href="assets/css/jkanban.min.css">
  <script src="assets/js/config.js"></script>
  <script src="assets/js/jkanban.min.js?v=1.1"></script>
</head>
<style>
#myKanban {
  overflow-x: auto;
  padding: 20px 0;
}
.kanban-board{
  background: #88d9e2 !important;
}
header .btn, .btn.btn-default{
  background-color: #00bcd4 !important;
}
</style>
<body class="">
  <div class="wrapper ">
    <div class="sidebar" style="display:none;" id="menu" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          FACILITA
        </a>
      </div>
      <div class="sidebar-wrapper">
        <?php include 'menu.php'; ?>
      </div>
    </div>
    <style>
    .main-panel{
      width: 100%;
    }
    </style>
    <div class="main-panel" id="base">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div onclick="menu();">
            <img id="image-menu" src="assets/img/menu.png" width="32px" height="32px">
            </div>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <!-- <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Pesquisar...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form> -->
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
                  <h4 class="card-title ">Cronograma</h4>
                  <p class="card-category"> Seus projetos sendo manipuladas com kanban</p>
                </div>
                <div class="card-body">

                <div class="container-fluid">
                  <div class="row">
                      <div class="col-md-12">

                      <?php

                      $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND ultima ='1' AND status='1';";
                      $result = mysqli_query($conn, $consulta);
                      $row = mysqli_fetch_assoc($result);

                      $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND inicial ='1' AND status='1';";
                      $result = mysqli_query($conn, $consulta);
                      $rowInicial = mysqli_fetch_assoc($result);

                      $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND final ='1' AND status='1';";
                      $result = mysqli_query($conn, $consulta);
                      $rowFinal = mysqli_fetch_assoc($result);

                      if(!$row || !$rowInicial || !$rowFinal){

                      ?>

                      <div class="alert alert-danger">
                        <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button> -->
                        <span>
                          <b> Aviso - </b> É necessário ir em etapas e definir uma etapa como etapa inicial, final e última!</span>
                      </div>

                      <?php } else { ?>
                        <style>
                        .box-inline{
                          margin-top:10px;display: flex;align-items: center;padding-left:10px;
                        }
                        </style>
                        <div style="display:flex;">
                        <h3 style="margin-left:10px;">Legenda:</h3>
                        <div class="box-inline">
                          <div style="background:#FFF;width:32px;height:32px;border:1px solid #000;"></div><b style="margin-left:10px;"> Faltam mais de 5 dias</b>
                        </div>
                        <div class="box-inline">
                          <div style="background:#ff9800;width:32px;height:32px;"></div><b style="margin-left:10px;"> Faltam menos ou igual a 5 dias</b>
                        </div>
                        <div class="box-inline">
                          <div style="background:#f44336;width:32px;height:32px;"></div><b style="margin-left:10px;"> Faltam 0 dias (atrasado)</b>
                        </div>
                        </div>
                        <div id="myKanban"></div>
                      <?php } ?>
                      </div>
                  </div>
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
  <script src="assets/js/axios.min.js"></script>
  <script src="assets/js/moment.js"></script>
  <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

  <?php 
          $consulta = "SELECT V.codigo as CodigoVenda,
                              C.nome as cliente,
                              C.cnpj as cnpj,
                              V.valor as total,
                              V.data_inicial as inicio,
                              V.data_final as fim,
                              V.token as token
                       FROM Venda as V
                       INNER JOIN Cliente AS C ON (C.codigo = V.FK_Cliente_Codigo)
                       WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.status = 1 ORDER BY V.codigo DESC;";
          $result = mysqli_query($conn, $consulta);
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
          ?>
  <!-- Modal -->
  <div id="venda<?php echo $row['CodigoVenda']; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <p><h3><?php echo $row['cliente']; ?></h3></p>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <div class="modal-body">
          <p><b>CNPJ: </b><?php echo $row['cnpj']; ?></p>
          <p><b>Data inicial: </b><?php echo date("d/m/Y", strtotime($row['inicio'])); ?></p>
          <p><b>Data final: </b><?php echo date("d/m/Y", strtotime($row['fim'])); ?></p>
        </div>
        <div class="modal-footer" style="display:block;">
                <p><b>Projeto: </b> <?php echo $row['CodigoVenda']; ?></p>
                <table class="table">
                <thead>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Total</th>
                </thead>
                <tbody>
                <?php
              $consulta = "SELECT P.*, IV.quantidade, IV.valor FROM Produto AS P
              INNER JOIN Item_Venda as IV ON (IV.FK_Produto_Codigo = P.codigo)
              INNER JOIN Venda AS V on (V.codigo = IV.FK_Venda_Codigo)
              WHERE P.empresa = '{$_SESSION["empresa"]}' AND V.codigo = '{$row['CodigoVenda']}';";
              $resultProdutos = mysqli_query($conn, $consulta);
              if (mysqli_num_rows($resultProdutos) > 0) {
              while($rowProdutos = mysqli_fetch_assoc($resultProdutos)) { ?>
              <tr>
              <td><?php echo $rowProdutos['nome']; ?></td>
              <td><?php echo $rowProdutos['quantidade']; ?></td>
              <td>R$ <?php echo number_format(($rowProdutos['valor']*$rowProdutos['quantidade']),2, ',', '.'); ?></td>
              </tr>
              <?php } } ?>
              <tr><td></td><td></td><td>R$ <?php echo number_format($row['total'],2, ',', '.'); ?></td></tr>
                </tbody>
                </table>
        </div>
        <div class="modal-footer" style="display:block;">
          <p><b>Realizações: </b> </p>

          <table class="table">
          <thead>
                <th>Etapa</th>
                <th>Data</th>
                <th>Usuário</th>
                </thead>
                <tbody>
          <?php
              $consulta = "SELECT E.nome AS etapa, IE.data_inicial, U.nome AS usuario 
              FROM Venda AS V
              INNER JOIN Item_Etapa as IE ON (IE.FK_Venda_codigo = V.codigo)
              INNER JOIN Etapa AS E ON (E.codigo = IE.FK_Etapa_Codigo)
              INNER JOIN Usuario AS U ON (U.codigo = IE.FK_Usuario_Codigo)
              WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.codigo= '{$row['CodigoVenda']}';";
              $resultProdutos = mysqli_query($conn, $consulta);
              if (mysqli_num_rows($resultProdutos) > 0) {
              while($rowProdutos = mysqli_fetch_assoc($resultProdutos)) { ?>
              <tr>
              <td><?php echo $rowProdutos['etapa']; ?></td>
              <td><?php echo date("d/m/Y H:i", strtotime($rowProdutos['data_inicial'])); ?></td>
              <td><?php echo $rowProdutos['usuario']; ?></td>
              </tr>
              <?php } } else { ?>
              <tr><td colspan="4" style="text-align:center;">Nenhuma etapa realizada.</td></tr>
                <?php } ?>
              </tbody>
                </table>
        </div>
        <?php if($row['token']){ ?>
        <div class="modal-footer" style="display:block;">
        <p><b>Token: </b><?php echo $row['token'];?></p>
        </div>
        <?php } ?> 
      </div>

    </div>
  </div>

  <?php } } ?>

  <style>
  
  .danger{
    background: #f44336;
    color: #FFF;
  }

  .orange{
    background: #ff9800;
    color: #FFF;
  }

  .green{
    background: #4caf50;
    color: #FFF;
  }
  
  </style>

  <!-- Modal -->
  <div id="finalizarProjeto" class="modal fade" role="dialog" data-keyboard="false">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <p><h3>Finalizar projeto</h3></p>
        </div>
        <div class="modal-body">
        <p style="text-align:justify;">Esta alteração implica em uma mudança permanente, não haverá possibilidade de desfazer. Confirma?</p>
        </div>
        <div class="modal-footer">
          <button id="buttonFinalizarConcluir" class="btn btn-success">Concluir</button>
          <button id="buttonFinalizarCancel" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
      </div>

    </div>
  </div>

  <div id="modalPassar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <p><h3>OBSERVAÇÕES</h3></p>
        </div>
        <div class="modal-body">
        <div class="form-group">
            <textarea name="observacoes" id="observacoes" cols="30" rows="10" class="form-control" placeholder="Digite sua observação aqui!!!!"></textarea>
            <script>
                CKEDITOR.config.allowedContent = true;
                CKEDITOR.plugins.addExternal( 'iframe', 'assets/iframe/', 'plugin.js' );
                CKEDITOR.replace( 'observacoes');
            </script>
          </div>
          <div id="token"  data-toggle="tooltip" data-placement="top" title="Envie esse token para o cliente para acessar: facilita.com.br/rastreio.php">Token: <?php echo md5(date("d/m/Y H:i:s")); ?></div>
          <input type="hidden" id="tokenValue" value="<?php echo md5(date("d/m/Y H:i:s")); ?>">
        </div>
        <div class="modal-footer">
          <button id="buttonFinalizarConcluirPassar" class="btn btn-success">Concluir</button>
        </div>
      </div>

    </div>
  </div>
  <script>
  $('[data-toggle="tooltip"]').tooltip();
  
  function classDate(dataFinal){
    if(moment(dataFinal).isBefore(moment())){
      return "danger"
    } else if(moment(dataFinal).isBetween(moment(), moment().add(5, 'days'))){
      return "orange"
    }

    console.log(moment(dataFinal).isBetween(moment(), moment().add(5, 'days')));
    
    console.log("Final: ", moment(dataFinal));
    console.log("Dias: ", moment().add(5, 'days'));
    console.log("---");
    
    // ajustar data laranja
  }

  <?php 
      $array = array();
      $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND status = 1 ORDER BY ordem ASC;";
      $result = mysqli_query($conn, $consulta);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          array_push($array,"_".$row['nome']);
        } 
      }
  ?>
  var string_array = "<?php echo implode("|", $array); ?>";
  var array_produtos = string_array.split("|");

<?php
  $consultaFinal = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND status = 1 AND ultima = 1;";
  $resultFinal = mysqli_query($conn, $consultaFinal);
  $rowFinal = mysqli_fetch_assoc($resultFinal);
?>

<?php
  $consultaFinal = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND status = 1 AND inicial = 1;";
  $resultFinal = mysqli_query($conn, $consultaFinal);
  $rowInicial = mysqli_fetch_assoc($resultFinal);
?>

var KanbanTest = new jKanban({
        element: "#myKanban",
        gutter: "10px",
        widthBoard: "300px",
        click: function(el) {
          $('#venda'+el.dataset.eid).modal('show');
        },
        dropEl: function (el, target, source, sibling) {

          if(target.parentElement.dataset.id != "_InicioBoard"){

            if(source.parentElement.dataset.id == "_<?php echo $rowFinal["nome"]; ?>"){
              return;
            } else

            if(target.parentElement.dataset.id == "_<?php echo $rowFinal["nome"]; ?>") {

              $('#finalizarProjeto').modal({backdrop: 'static', keyboard: false},'show');

              document.getElementById("buttonFinalizarCancel").addEventListener("click", function(){
                document.location.reload(true);
              });

              document.getElementById("buttonFinalizarConcluir").addEventListener("click", function(){
                axios.post('api.php', {
                  local: 'nova_etapa',
                  venda: ''+el.dataset.eid,
                  antigo: ''+source.parentElement.dataset.id,
                  novo: ''+target.parentElement.dataset.id
                })
                .then(function (response) {
                  document.location.reload(true);
                });
              });

            } else {

              $('#modalPassar').modal({backdrop: 'static', keyboard: false},'show');

              if(target.parentElement.dataset.id == "_<?php echo $rowInicial["nome"]; ?>") {
                $("#token").css("display", "block");
              } else {
                $("#token").css("display", "none");
              }

              document.getElementById("buttonFinalizarConcluirPassar").addEventListener("click", function(){
                var value = CKEDITOR.instances.observacoes.getData();
                  axios.post('api.php', {
                  local: 'nova_etapa',
                  venda: ''+el.dataset.eid,
                  antigo: ''+source.parentElement.dataset.id,
                  novo: ''+target.parentElement.dataset.id,
                  usuario: "<?php echo $_SESSION['codigo']; ?>",
                  descricao: ""+value,
                  token: ""+$("#tokenValue").val()
                })
                .then(function (response) {
                  const boards = document.querySelector('[data-id="'+target.parentElement.dataset.id+'"]').parentElement;
                  const childrens = Array.prototype.slice.call(boards.children)
                  var posicao = 0;
                  for(var i=0; i<childrens.length; i++){
                    if(target.parentElement.dataset.id == childrens[i].dataset.id){
                      posicao = i*300;
                    }
                  }
                  window.location.href="<?php echo $_SERVER['PHP_SELF']; ?>?card="+posicao;
                });
              });

            }

            
          }

        },
        addItemButton: false,
        boards: [
          {
            id: "_InicioBoard",
            title: "Projetos #",
            class: "info,good",
            dragTo: this.array_produtos,
            item: [
              <?php 
          $consulta = "SELECT * FROM Venda AS V
                        WHERE V.empresa = '{$_SESSION["empresa"]}' 
                        AND NOT EXISTS(SELECT * FROM Item_Etapa WHERE FK_Venda_Codigo = V.codigo) 
                        AND V.status = 1
                        ORDER BY V.codigo DESC;";
          $result = mysqli_query($conn, $consulta);
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
          ?>
              {id: "<?php echo $row['codigo']; ?>", title:"<?php echo $row['nome']; ?>",classe: classDate('<?php echo $row['data_final']; ?>')}
              <?php echo (mysqli_num_rows($result)==$i+1) ? "" : "," ?>
          <?php $i++; } } $i=0; ?>
              ]
          },
          <?php 
          $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND status = 1 AND ultima = 0 ORDER BY ordem ASC;";
          $result = mysqli_query($conn, $consulta);
          if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
          ?>
          {
            id: "_<?php echo $row['nome']; ?>",
            title: "<?php echo $row['nome']; ?>",
            class: "info,good",
            dragTo: this.array_produtos,
            item: [
              <?php 
              $j = 0;
          $consulta = "SELECT V.codigo as codigo,
                              V.nome as nome,
                              V.data_final as final
                       FROM Venda AS V
                       INNER JOIN Item_Etapa AS IE ON (V.codigo = IE.FK_Venda_Codigo)
                       WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.status = 1 AND IE.FK_Etapa_Codigo = '{$row['codigo']}' 
                       AND IE.data_final IS NULL ORDER BY V.codigo DESC;";
          $resultCards = mysqli_query($conn, $consulta);
          if (mysqli_num_rows($resultCards) > 0) {
            while($rowCards = mysqli_fetch_assoc($resultCards)) {
          ?>
              {
                id: "<?php echo $rowCards['codigo']; ?>", 
                title:"<?php echo $rowCards['nome']; ?>",
                classe: classDate('<?php echo $rowCards['final']; ?>')
              }
              <?php echo (mysqli_num_rows($resultCards)==$j+1) ? "" : "," ?>
          <?php $j++; } } $j=0; ?>
            ]
          } <?php echo (mysqli_num_rows($result)==$i+1) ? "" : "," ?>
          <?php $i++; } } ?>

          <?php 
          $consultaFinal = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND status = 1 AND ultima = 1;";
          $resultFinal = mysqli_query($conn, $consultaFinal);
          $rowFinal = mysqli_fetch_assoc($resultFinal);
          ?>
          ,{
            id: "_<?php echo $rowFinal['nome']; ?>",
            title: "<?php echo $rowFinal['nome']; ?>",
            class: "info,good",
            dragTo: [],
            item: [
              <?php 
              $j = 0;
          $consulta = "SELECT V.codigo as codigo,
                              V.nome as nome,
                              V.data_final as final
                       FROM Venda AS V
                       INNER JOIN Item_Etapa AS IE ON (V.codigo = IE.FK_Venda_Codigo)
                       WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.status = 1 AND IE.FK_Etapa_Codigo = '{$rowFinal['codigo']}' 
                       AND IE.data_final IS NULL ORDER BY V.codigo DESC;";
          $resultCards = mysqli_query($conn, $consulta);
          if (mysqli_num_rows($resultCards) > 0) {
            while($rowCards = mysqli_fetch_assoc($resultCards)) {
          ?>
              {
                id: "<?php echo $rowCards['codigo']; ?>", 
                title:"<?php echo $rowCards['nome']; ?>",
                classe: "green"
              }
              <?php echo (mysqli_num_rows($resultCards)==$j+1) ? "" : "," ?>
          <?php $j++; } } $j=0; ?>
            ]
          }

        ]
      });
      // var toDoButton = document.getElementById("addToDo");
      // toDoButton.addEventListener("click", function() {
      //   KanbanTest.addElement("_todo", {
      //     title: "Novo Item"
      //   });
      // });
      // var addBoardDefault = document.getElementById("addDefault");
      // addBoardDefault.addEventListener("click", function() {
      //   KanbanTest.addBoards([
      //     {
      //       id: "_default",
      //       title: "Novo Card",
      //       item: [
      //         {
      //           title: "Novo Item"
      //         },
      //       ]
      //     }
      //   ]);
      // });
      // var removeBoard = document.getElementById("removeBoard");
      // removeBoard.addEventListener("click", function() {
      //   KanbanTest.removeBoard("_default");
      // });
      // var removeElement = document.getElementById("removeElement");
      // removeElement.addEventListener("click", function() {
      //   KanbanTest.removeElement("_test_delete");
      // });
      // var allEle = KanbanTest.getBoardElements("_todo");
      // allEle.forEach(function(item, index) {
      //   //console.log(item);
      // });

      var aberto = 0;
      function menu(){
        if(aberto === 0){
          $("#image-menu").attr("src", "assets/img/close.png");

          $("#menu").css("-webkit-transition-property", "top, bottom, width");
          $("#menu").css("transition-property", "top, bottom, width");
          $("#menu").css("-webkit-transition-duration", ".2s, .2s, .35s");
          $("#menu").css("transition-duration", ".2s, .2s, .35s");
          $("#menu").css("-webkit-transition-timing-function", "linear, linear, ease");
          $("#menu").css("transition-timing-function", "linear, linear, ease");
          $("#menu").css("-webkit-overflow-scrolling", "touch");

          $("#menu").css("display", "block");
          $("#base").css("width", "calc(100% - 260px)");
          aberto = 1;
        } else {
          $("#image-menu").attr("src", "assets/img/menu.png");
          $("#menu").css("display", "none");
          $("#base").css("width", "100%");
          aberto = 0;
        }
      }

      function goToCard(){
        const card = "<?php echo $_GET['card']; ?>";
        if(card.length > 0){          
          $('#myKanban').animate({scrollLeft:'+='+card},300);
        }        
      }
      goToCard();

  </script>
</body>

</html>
