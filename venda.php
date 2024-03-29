<?php
	include 'conexao.php';

	if(isset($_POST['cliente'])){
    
    $cliente = addslashes($_POST['cliente']);
    $inicio = addslashes($_POST['inicio']);
    $fim = addslashes($_POST['fim']);
    $usuario = $_SESSION["codigo"];

    $status = "1";

    $consulta = "SELECT * FROM Cliente WHERE empresa = '{$_SESSION["empresa"]}' AND codigo ='{$cliente}'";
		$result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);
    $cliente_nome = $row["nome"];

    $totalNovas = (int) $_POST['TotalNovas'];

    $total = 0;

    if($totalNovas > 0){
      for ($i=1; $i <= $totalNovas; $i++) { 
        $produto = $_POST['produto'.$i];
        $quantidade = $_POST['quantidade'.$i];

        $consulta = "SELECT * FROM Produto WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$produto}'";
        $result = mysqli_query($conn, $consulta);
        $row = mysqli_fetch_assoc($result);
        $total = $total + ($quantidade * $row["preco"]);
      }
    }

		$sql = "INSERT INTO Venda (nome, valor, data_inicial, data_final, status, FK_Cliente_codigo, FK_Usuario_codigo, empresa)
						VALUES ('{$cliente_nome}', '{$total}', '{$inicio}', '{$fim}', '{$status}', '{$cliente}', '{$usuario}', '{$_SESSION["empresa"]}')";
    $sucesso = mysqli_query($conn, $sql);

    $consulta = "SELECT * FROM Venda WHERE empresa = '{$_SESSION["empresa"]}' ORDER BY codigo DESC LIMIT 1";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);
    $venda = $row["codigo"];

    if($totalNovas > 0){
      for ($i=1; $i <= $totalNovas; $i++) { 
        $produto = $_POST['produto'.$i];
        $quantidade = $_POST['quantidade'.$i];

        $consulta = "SELECT * FROM Produto WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$produto}'";
        $result = mysqli_query($conn, $consulta);
        $row = mysqli_fetch_assoc($result);
        $preco = $row["preco"];

        $sql = "INSERT INTO Item_Venda (quantidade, valor, FK_Venda_codigo, FK_Produto_codigo, empresa)
						VALUES ('{$quantidade}', '{$preco}', '{$venda}', '{$produto}', '{$_SESSION["empresa"]}')";
        $sucesso = mysqli_query($conn, $sql);
      }
    }
    
    header('Location: vendas.php');

  } else {
    havePermission($conn, 'projeto', 'projeto_cadastrar');
  }
  
  $id = 0;
	if(isset($_GET['id'])){

    havePermission($conn, 'projeto', 'projeto_editar');

		$id = (int) $_GET['id'];

    $consulta = "SELECT V.codigo as CodigoVenda,
                        C.nome as cliente,
                        C.cnpj as cnpj,
                        V.valor as total,
                        V.data_inicial as inicio,
                        V.data_final as fim,
                        V.token as token,
                        U.nome as usuario,
                        V.cadastro as cadastro
                        FROM Venda as V
                        INNER JOIN Cliente AS C ON (C.codigo = V.FK_Cliente_Codigo)
                        INNER JOIN Usuario AS U ON (V.FK_Usuario_codigo = U.codigo)
                        WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.codigo = '{$id}';";
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
            <a class="navbar-brand" href="#pablo">Projeto</a>
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
                <div class="card-header card-header-primary" style="display:flex;justify-content: space-between;">
                <div>
                <?php if($id > 0){ ?>
                  <h4 class="card-title">Projeto</h4>
                  <p class="card-category">Dados do seu projeto!</p>
                <?php } else { ?>
                  <h4 class="card-title">Cadastrar Projeto</h4>
                  <p class="card-category">Informe os dados do novo projeto!</p>
                <?php } ?>
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
                  <?php if($id>0){ ?>
                    <div class="box-imprimir" onclick="javascript:window.print();">
                      <i class="material-icons">print</i>
                      Imprimir
                    </div>
                  <?php } ?>
                </div>
                <div class="card-body">
                  

                    <?php if($id>0){ ?>
                      
                      <div class="row">

                        <div class="col-md-12">
                          <div style="display:grid;grid-template-columns: 1fr 1fr;">
                            <div style="display:grid;grid-template-columns: 1fr 1fr;">
                              <b>Cliente: </b><?php echo $row['cliente']; ?>
                            </div>
                            <div style="display:grid;grid-template-columns: 1fr 1fr;">
                              <b>CNPJ: </b><?php echo $row['cnpj']; ?>
                            </div>
                          </div>
                          <hr>
                          <div style="display:grid;grid-template-columns: 1fr 1fr;">
                            <div style="display:grid;grid-template-columns: 1fr 1fr;">
                              <b>Data inicial: </b><?php echo date("d/m/Y", strtotime($row['inicio'])); ?>
                              <b>Data final: </b><?php echo date("d/m/Y", strtotime($row['fim'])); ?>
                            </div>
                            <div style="display:grid;grid-template-columns: 1fr 1fr;">
                              <b>Funcionário: </b><?php echo $row['usuario']; ?>
                              <b>Data cadastro: </b><?php echo date("d/m/Y", strtotime($row['cadastro'])); ?>
                            </div>
                          </div>
                          <hr>
                          <?php if($row['token']){ ?>
                            <p><b>Token: </b><?php echo $row['token'];?></p>
                            <hr>
                          <?php } ?> 
                        </div>

                        <div class="col-md-12">
                          <br>
                          <p><b>Projeto: </b> <?php echo $row['CodigoVenda']; ?></p>
                        </div>

                        <div class="col-md-12">

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
                                  while($rowProdutos = mysqli_fetch_assoc($resultProdutos)) { 
                                ?>
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

                        <div class="col-md-12">
                        
                          <p><b>Realizações: </b> </p>

                          <table class="table">
                            <thead>
                              <th>Etapa</th>
                              <th>Início</th>
                              <th>Fim</th>
                              <th>Usuário</th>
                              <th>Descrição</th>
                            </thead>
                            <tbody>
                              <?php
                                  $consulta = "SELECT IE.descricao, E.nome AS etapa, IE.data_inicial, IE.data_final, U.nome AS usuario 
                                  FROM Venda AS V
                                  INNER JOIN Item_Etapa as IE ON (IE.FK_Venda_codigo = V.codigo)
                                  INNER JOIN Etapa AS E ON (E.codigo = IE.FK_Etapa_Codigo)
                                  INNER JOIN Usuario AS U ON (U.codigo = IE.FK_Usuario_Codigo)
                                  WHERE V.empresa = '{$_SESSION["empresa"]}' AND V.codigo= '{$row['CodigoVenda']}' ORDER BY E.ordem;";
                                  $resultProdutos = mysqli_query($conn, $consulta);
                                  if (mysqli_num_rows($resultProdutos) > 0) {
                                  while($rowProdutos = mysqli_fetch_assoc($resultProdutos)) { 
                              ?>
                                    <tr>
                                      <td><?php echo $rowProdutos['etapa']; ?></td>
                                      <td><?php echo date("d/m/Y H:i", strtotime($rowProdutos['data_inicial'])); ?></td>
                                      <td><?php echo ($rowProdutos['data_final']) ? date("d/m/Y H:i", strtotime($rowProdutos['data_final'])) : ' - '; ?></td>
                                      <td><?php echo $rowProdutos['usuario']; ?></td>
                                      <td>
                                      <div style="width:100%;max-width:500px;max-height:300px;overflow:auto;">
                                      <?php echo $rowProdutos['descricao']; ?>
                                      </div>
                                      </td>
                                    </tr>
                              <?php } } else { ?>
                                  <tr><td colspan="4" style="text-align:center;">Nenhuma etapa realizada.</td></tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        
                        </div>

                      </div>

                    <?php } ?>

                  <?php if($id==0){ ?>

                    <form action="#" method="post">

                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Cliente</label>
                          <select <?php echo ($id>0) ? "disabled" : "" ?> name="cliente" class="form-control" required>
                          <?php
                          $consulta = "SELECT * FROM Cliente WHERE empresa = '{$_SESSION["empresa"]}' AND status='1';";
                          $result = mysqli_query($conn, $consulta);
                          if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) { ?>
                          <option value="<?php echo $row['codigo']; ?>" <?php echo ($id>0 && $row['codigo'] == $venda['FK_Cliente_codigo']) ? "selected" : "" ?>><?php echo $row['nome']; ?></option>
                            <?php }} ?>
                          
                          </select>
                        </div>
                      </div>
                    </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">Início do projeto</label>
                            <input required <?php echo ($id>0) ? "disabled" : "" ?> type="date" name="inicio" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="">fim do projeto</label>
                            <input required <?php echo ($id>0) ? "disabled" : "" ?> type="date" name="fim" class="form-control">
                          </div>
                        </div>
                      </div>

                      <div id="novasRespostas"></div>
                      <input type="hidden" name="TotalNovas" id="TotalNovas" value="0">
                      <div class="row">
                        <div class="col-md-12">
                          <button type="button" class="btn btn-primary" onclick="novaResposta()">Adicionar produto</button>
                        </div>
                      </div>

                      <div class="row" style="margin-top:10px;">
                        <div class="col-md-12">
                          <div class="form-group pull-right">
                            <h1 id="total">Total: R$ 0,00</h1>
                          </div>
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                      
                      <div class="clearfix"></div>
                    </form>

                    <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>

  var valorTotal = 0.0;

  function getTotal(){
    valorTotal = 0.0;
    let totalNovas = $("#TotalNovas").val();
    for (var i = 1; i <= totalNovas; i++) {
      var quantidade = $("#quantidade"+i).val();
      if(quantidade === ""){
        quantidade = 0;
        $("#quantidade"+i).val(0);
      }
      var id = $("#produto"+i).val();
      var valor = $("#produto_"+id).val();
      valorTotal = parseFloat(valorTotal) + (parseFloat(valor) * quantidade);
    }
    $("#total").html("Total: R$ "+valorTotal.toLocaleString('pt-br', {minimumFractionDigits: 2}));
  }

  function novaResposta(){

    var total = parseInt($("#TotalNovas").val());
    total = total + 1;
    var html = '';

    html += '<div class="row">';
    html += '<div class="col-md-12">';
    html += '<div class="form-group">';
    html += '<select name="produto'+total+'" id="produto'+total+'" class="form-control">';

    <?php
    $consulta = "SELECT * FROM Produto WHERE empresa = '{$_SESSION["empresa"]}' AND status='1';";
    $result = mysqli_query($conn, $consulta);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) { ?>
    html += '<option value="<?php echo $row['codigo']; ?>"><?php echo $row['nome']; ?></option>';
      <?php }} ?>
    html += '</select>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    html += '<div class="row">';
    html += '<div class="col-md-12">';
    html += '<div class="form-group">';
    html += '<label>Quantidade</label>';
    html += '<input type="number" name="quantidade'+total+'" id="quantidade'+total+'" class="form-control" required>';
    html += '</div>';
    html += '</div>';
    html += '</div>';

    html += '<div style="clear:both;"></div>';

    $(document).ready(function(){
      $("#quantidade"+total).keyup(function(e){
        if(e.keyCode == 8){
          getTotal();
        } else {
          var value = $("#quantidade"+total).val() * 1;
          $("#quantidade"+total).val(value);
        }
      });
      $("#quantidade"+total).keyup(function(){ 
        getTotal();
      });
      $("#produto"+total).change(function(){ 
        getTotal();
      });
    });

    <?php
    $consulta = "SELECT * FROM Produto WHERE empresa = '{$_SESSION["empresa"]}' AND status='1';";
    $result = mysqli_query($conn, $consulta);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) { ?>
    html += '<input type="hidden" id="produto_<?php echo $row['codigo']; ?>" value="<?php echo $row['preco']; ?>" />';
      <?php }} ?>

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
