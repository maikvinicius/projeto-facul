<?php
  include 'conexao.php';
  
  if(isset($_POST['nome'])){
    $permissao_usuario = serialize([
      "usuario_visualizar" => (isset($_POST['usuario_visualizar'])) ? 1 : 0,
      "usuario_cadastrar" => (isset($_POST['usuario_cadastrar'])) ? 1 : 0,
      "usuario_editar" => (isset($_POST['usuario_editar'])) ? 1 : 0,
      "usuario_desativar" => (isset($_POST['usuario_desativar'])) ? 1 : 0
    ]);

    $permissao_cliente = serialize([
      "cliente_visualizar" => (isset($_POST['cliente_visualizar'])) ? 1 : 0,
      "cliente_cadastrar" => (isset($_POST['cliente_cadastrar'])) ? 1 : 0,
      "cliente_editar" => (isset($_POST['cliente_editar'])) ? 1 : 0,
      "cliente_desativar" => (isset($_POST['cliente_desativar'])) ? 1 : 0
    ]);
    
    $permissao_cat_cliente = serialize([
      "cat_cliente_visualizar" => (isset($_POST['cat_cliente_visualizar'])) ? 1 : 0,
      "cat_cliente_cadastrar" => (isset($_POST['cat_cliente_cadastrar'])) ? 1 : 0,
      "cat_cliente_editar" => (isset($_POST['cat_cliente_editar'])) ? 1 : 0,
      "cat_cliente_desativar" => (isset($_POST['cat_cliente_desativar'])) ? 1 : 0
    ]);

    $permissao_cronograma = serialize([
      "cronograma_visualizar" => (isset($_POST['cronograma_visualizar'])) ? 1 : 0,
      "cronograma_cadastrar" => (isset($_POST['cronograma_cadastrar'])) ? 1 : 0,
      "cronograma_editar" => (isset($_POST['cronograma_editar'])) ? 1 : 0,
      "cronograma_desativar" => (isset($_POST['cronograma_desativar'])) ? 1 : 0
    ]);

    $permissao_etapa = serialize([
      "etapa_visualizar" => (isset($_POST['etapa_visualizar'])) ? 1 : 0,
      "etapa_cadastrar" => (isset($_POST['etapa_cadastrar'])) ? 1 : 0,
      "etapa_editar" => (isset($_POST['etapa_editar'])) ? 1 : 0,
      "etapa_desativar" => (isset($_POST['etapa_desativar'])) ? 1 : 0
    ]);

    $permissao_projeto = serialize([
      "projeto_visualizar" => (isset($_POST['projeto_visualizar'])) ? 1 : 0,
      "projeto_cadastrar" => (isset($_POST['projeto_cadastrar'])) ? 1 : 0,
      "projeto_editar" => (isset($_POST['projeto_editar'])) ? 1 : 0,
      "projeto_desativar" => (isset($_POST['projeto_desativar'])) ? 1 : 0
    ]);

    $permissao_produto = serialize([
      "produto_visualizar" => (isset($_POST['produto_visualizar'])) ? 1 : 0,
      "produto_cadastrar" => (isset($_POST['produto_cadastrar'])) ? 1 : 0,
      "produto_editar" => (isset($_POST['produto_editar'])) ? 1 : 0,
      "produto_desativar" => (isset($_POST['produto_desativar'])) ? 1 : 0
    ]);

    $permissao_cat_produto = serialize([
      "cat_produto_visualizar" => (isset($_POST['cat_produto_visualizar'])) ? 1 : 0,
      "cat_produto_cadastrar" => (isset($_POST['cat_produto_cadastrar'])) ? 1 : 0,
      "cat_produto_editar" => (isset($_POST['cat_produto_editar'])) ? 1 : 0,
      "cat_produto_desativar" => (isset($_POST['cat_produto_desativar'])) ? 1 : 0
    ]);

    $permissao_relatorio = serialize([
      "relatorio_visualizar" => (isset($_POST['relatorio_visualizar'])) ? 1 : 0,
      "relatorio_cadastrar" => (isset($_POST['relatorio_cadastrar'])) ? 1 : 0,
      "relatorio_editar" => (isset($_POST['relatorio_editar'])) ? 1 : 0,
      "relatorio_desativar" => (isset($_POST['relatorio_desativar'])) ? 1 : 0
    ]);
  }

	$id = 0;
	if(isset($_GET['id'])){

    havePermission($conn, 'usuario', 'usuario_editar');

		$id = (int) $_GET['id'];

		if(isset($_POST['nome'])){
      $nome = addslashes($_POST['nome']);
      $telefone = addslashes($_POST['telefone']);
      $email = addslashes($_POST['email']);
      $login = addslashes($_POST['login']);
      $senha = addslashes($_POST['senha']);

      $status = "0";
      if(isset($_POST['status'])){
        $status = "1";
      }
      
			$sql = "UPDATE Usuario SET nome='{$nome}', 
                                 telefone='{$telefone}',
                                 email='{$email}', 
                                 login='{$login}', 
                                 senha='{$senha}',
                                 status='{$status}'  
              WHERE empresa = '{$_SESSION["empresa"]}' AND codigo='{$id}'";
      $sucesso = mysqli_query($conn, $sql);

      $sql = "UPDATE Permissao SET
                     usuario='{$permissao_usuario}', cliente='{$permissao_cliente}', 
                     cat_cliente='{$permissao_cat_cliente}', cronograma='{$permissao_cronograma}', 
                     etapa='{$permissao_etapa}', projeto='{$permissao_projeto}', 
                     produto='{$permissao_produto}', cat_produto='{$permissao_cat_produto}', 
                     relatorio='{$permissao_relatorio}' WHERE FK_Usuario_codigo = '{$id}';";

      $sucesso = mysqli_query($conn, $sql);

      $consulta = "SELECT * FROM Permissao WHERE FK_Usuario_codigo ='{$id}'";
      $result = mysqli_query($conn, $consulta);
      $rowPermissao = mysqli_fetch_assoc($result);

      header('Location: usuarios.php');

		}

		$consulta = "SELECT * FROM Usuario WHERE empresa = '{$_SESSION["empresa"]}' AND codigo ='{$id}'";
		$result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);
    
    $consulta = "SELECT * FROM Permissao WHERE FK_Usuario_codigo ='{$id}'";
		$result = mysqli_query($conn, $consulta);
    $rowPermissao = mysqli_fetch_assoc($result);

	} else if(isset($_POST['nome'])){
    
    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $login = addslashes($_POST['login']);
    $senha = addslashes($_POST['senha']);
    $responsavel = $_SESSION["codigo"];

    $status = "0";
    if(isset($_POST['status'])){
      $status = "1";
    }

		$sql = "INSERT INTO Usuario (nome, telefone, email, login, senha, responsavel, status, empresa)
						VALUES ('{$nome}', '{$telefone}', '{$email}', '{$login}', '{$senha}', '{$responsavel}', '{$status}', '{$_SESSION["empresa"]}')";
    $sucesso = mysqli_query($conn, $sql);

    $consulta = "SELECT * FROM Usuario ORDER BY codigo DESC LIMIT 1";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO Permissao (usuario, cliente, cat_cliente, cronograma, etapa, projeto, produto, cat_produto, relatorio, FK_Usuario_codigo)
						VALUES ('{$permissao_usuario}', '{$permissao_cliente}', '{$permissao_cat_cliente}', 
                    '{$permissao_cronograma}', '{$permissao_etapa}', '{$permissao_projeto}',
                    '{$permissao_produto}', '{$permissao_cat_produto}', '{$permissao_relatorio}',  '{$row["codigo"]}')";
    $sucesso = mysqli_query($conn, $sql);
    
    header('Location: usuarios.php');

	} else {
    havePermission($conn, 'usuario', 'usuario_cadastrar');
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

<script type="text/javascript">
  /* M�scaras ER */
  function mascara(o,f){
      v_obj=o
      v_fun=f
      setTimeout("execmascara()",1)
  }
  function execmascara(){
      v_obj.value=v_fun(v_obj.value)
  }
  //Mascara para Telefone
  function mtel(v){
      v=v.replace(/\D/g,"");             //Remove tudo o que n�o � d�gito
      v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca par�nteses em volta dos dois primeiros d�gitos
      v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca h�fen entre o quarto e o quinto d�gitos
      return v;
  }
  //Mascara para Celular
  function mcel(v){
      v=v.replace(/\D/g,"");             //Remove tudo o que n�o � d�gito
      v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca par�nteses em volta dos dois primeiros d�gitos
      v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca h�fen entre o quinto e o sexto d�gitos
      return v;
  }
  function id( el ){
      return document.getElementById( el );
  }
</script>

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
            <a class="navbar-brand" href="#pablo">Usuário</a>
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
                  <h4 class="card-title">Cadastrar usuário</h4>
                  <p class="card-category">Informe os dados de quem utilizará o sistema!</p>
                </div>
                <div class="card-body">
                  <form action="#" method="post">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Nome</label>
                          <input type="text" name="nome" value="<?php echo ($id>0) ? $row['nome'] : "" ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Telefone</label>
                          <input type="text" name="telefone" value="<?php echo ($id>0) ? $row['telefone'] : "" ?>" class="form-control" onkeyup="mascara(this, mcel)" maxlength="15">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" name="email" value="<?php echo ($id>0) ? $row['email'] : "" ?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Login</label>
                          <input type="text" name="login" value="<?php echo ($id>0) ? $row['login'] : "" ?>" class="form-control" required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">Senha</label>
                          <input type="text" name="senha" value="<?php echo ($id>0) ? $row['senha'] : "" ?>" class="form-control" required>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Status</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" name="status" value="1" <?php echo ($id>0 && $row['status'] == '1') ? checked : "" ?>> Ativar</label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <h3>Cadastrar Permissões</h3>
                      </div>
                        </div>
                      </div>
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Usuários</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['usuario'])['usuario_visualizar']) ? "checked" : "" ?> name="usuario_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['usuario'])['usuario_cadastrar']) ? "checked" : "" ?> name="usuario_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['usuario'])['usuario_editar']) ? "checked" : "" ?> name="usuario_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['usuario'])['usuario_desativar']) ? "checked" : "" ?> name="usuario_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Clientes</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cliente'])['cliente_visualizar']) ? "checked" : "" ?> name="cliente_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cliente'])['cliente_cadastrar']) ? "checked" : "" ?> name="cliente_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cliente'])['cliente_editar']) ? "checked" : "" ?> name="cliente_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cliente'])['cliente_desativar']) ? "checked" : "" ?> name="cliente_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Categoria de Clientes</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_cliente'])['cat_cliente_visualizar']) ? "checked" : "" ?> name="cat_cliente_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_cliente'])['cat_cliente_cadastrar']) ? "checked" : "" ?> name="cat_cliente_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_cliente'])['cat_cliente_editar']) ? "checked" : "" ?> name="cat_cliente_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_cliente'])['cat_cliente_desativar']) ? "checked" : "" ?> name="cat_cliente_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Cronograma</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cronograma'])['cronograma_visualizar']) ? "checked" : "" ?> name="cronograma_visualizar" value="1"> Manipular</label>
                            </div>
                           <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cronograma'])['cronograma_cadastrar']) ? "checked" : "" ?> name="cronograma_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cronograma'])['cronograma_editar']) ? "checked" : "" ?> name="cronograma_editar" value="1"> Editar</label>
                            </div> -->
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cronograma'])['cronograma_desativar']) ? "checked" : "" ?> name="cronograma_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Etapas</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['etapa'])['etapa_visualizar']) ? "checked" : "" ?> name="etapa_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['etapa'])['etapa_cadastrar']) ? "checked" : "" ?> name="etapa_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['etapa'])['etapa_editar']) ? "checked" : "" ?> name="etapa_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['etapa'])['etapa_desativar']) ? "checked" : "" ?> name="etapa_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Projetos</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['projeto'])['projeto_visualizar']) ? "checked" : "" ?> name="projeto_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['projeto'])['projeto_cadastrar']) ? "checked" : "" ?> name="projeto_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['projeto'])['projeto_editar']) ? "checked" : "" ?> name="projeto_editar" value="1"> Detalhes</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['projeto'])['projeto_desativar']) ? "checked" : "" ?> name="projeto_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Produtos</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['produto'])['produto_visualizar']) ? "checked" : "" ?> name="produto_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['produto'])['produto_cadastrar']) ? "checked" : "" ?> name="produto_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['produto'])['produto_editar']) ? "checked" : "" ?> name="produto_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['produto'])['produto_desativar']) ? "checked" : "" ?> name="produto_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Categoria de Produtos</label>
                          <div class="form-group">
                          <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_produto'])['cat_produto_visualizar']) ? "checked" : "" ?> name="cat_produto_visualizar" value="1"> Visualizar</label>
                            </div>
                           <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_produto'])['cat_produto_cadastrar']) ? "checked" : "" ?> name="cat_produto_cadastrar" value="1"> Cadastrar</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_produto'])['cat_produto_editar']) ? "checked" : "" ?> name="cat_produto_editar" value="1"> Editar</label>
                            </div>
                            <!-- <div class="checkbox">
                              <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['cat_produto'])['cat_produto_desativar']) ? "checked" : "" ?> name="cat_produto_desativar" value="1"> Desativar</label>
                            </div> -->
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>Relatórios</label>
                            <div class="form-group">
                              <div class="checkbox">
                                <label><input type="checkbox" <?php echo ($id>0 && unserialize($rowPermissao['relatorio'])['relatorio_visualizar']) ? "checked" : "" ?> name="relatorio_visualizar" value="1"> Visualizar</label>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    
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
</body>

</html>
