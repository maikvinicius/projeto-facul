<?php
include 'conexaoGeral.php';

$_SESSION["logado"] = false;

if(isset($_POST['login']) && isset($_POST['senha'])) {

    $permissao_usuario = serialize([
      "usuario_visualizar" => 1,
      "usuario_cadastrar" => 1,
      "usuario_editar" => 1,
      "usuario_desativar" => 1
    ]);

    $permissao_cliente = serialize([
      "cliente_visualizar" => 1,
      "cliente_cadastrar" => 1,
      "cliente_editar" => 1,
      "cliente_desativar" => 1
    ]);
    
    $permissao_cat_cliente = serialize([
      "cat_cliente_visualizar" => 1,
      "cat_cliente_cadastrar" => 1,
      "cat_cliente_editar" => 1,
      "cat_cliente_desativar" => 1
    ]);

    $permissao_cronograma = serialize([
      "cronograma_visualizar" => 1,
      "cronograma_cadastrar" => 1,
      "cronograma_editar" => 1,
      "cronograma_desativar" => 1
    ]);

    $permissao_etapa = serialize([
      "etapa_visualizar" => 1,
      "etapa_cadastrar" => 1,
      "etapa_editar" => 1,
      "etapa_desativar" => 1
    ]);

    $permissao_projeto = serialize([
      "projeto_visualizar" => 1,
      "projeto_cadastrar" => 1,
      "projeto_editar" => 1,
      "projeto_desativar" => 1
    ]);

    $permissao_produto = serialize([
      "produto_visualizar" => 1,
      "produto_cadastrar" => 1,
      "produto_editar" => 1,
      "produto_desativar" => 1
    ]);

    $permissao_cat_produto = serialize([
      "cat_produto_visualizar" => 1,
      "cat_produto_cadastrar" => 1,
      "cat_produto_editar" => 1,
      "cat_produto_desativar" => 1
    ]);

    $permissao_relatorio = serialize([
      "relatorio_visualizar" => 1,
      "relatorio_cadastrar" => 1,
      "relatorio_editar" => 1,
      "relatorio_desativar" => 1
    ]);

    $nome = addslashes($_POST['nome']);
    $telefone = addslashes($_POST['telefone']);
    $email = addslashes($_POST['email']);
    $login = addslashes($_POST['login']);
    $senha = addslashes($_POST['senha']);
    $status = 1;
    $empresa = addslashes($_POST['empresa']);
    $cnpj = addslashes($_POST['cnpj']);

    $sql = "INSERT INTO Empresa (nome, cnpj)
            VALUES ('{$empresa}', '{$cnpj}')";
    $sucesso = mysqli_query($conn, $sql);

    $consulta = "SELECT * FROM Empresa ORDER BY codigo DESC LIMIT 1";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);
    
    $sql = "INSERT INTO Usuario (nome, telefone, email, login, senha, status, empresa)
            VALUES ('{$nome}', '{$telefone}', '{$email}', '{$login}', '{$senha}', '{$status}', '{$row["codigo"]}')";
    $sucesso = mysqli_query($conn, $sql);

    $consulta = "SELECT * FROM Usuario WHERE login = '{$login}' AND senha ='{$senha}' AND status = '1'";
    $result = mysqli_query($conn, $consulta);
    $row = mysqli_fetch_assoc($result);

    $sql = "INSERT INTO Permissao (usuario, cliente, cat_cliente, cronograma, etapa, projeto, produto, cat_produto, relatorio, FK_Usuario_codigo)
						VALUES ('{$permissao_usuario}', '{$permissao_cliente}', '{$permissao_cat_cliente}', 
                    '{$permissao_cronograma}', '{$permissao_etapa}', '{$permissao_projeto}',
                    '{$permissao_produto}', '{$permissao_cat_produto}', '{$permissao_relatorio}',  '{$row["codigo"]}')";
    $sucesso = mysqli_query($conn, $sql);

    if($row){
        $_SESSION["logado"] = true;
        $_SESSION["codigo"] = $row['codigo'];
        $_SESSION["empresa"] = $row['empresa'];
        header('Location: dashboard.php');
    } else{
        header('Location: index.php');
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
  //Mascara para CPF
  function mcpf(v){
    v=v.replace(/\D/g,"")                 //Remove tudo o que n�o � d�gito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto d�gitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava d�gitos
    v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo d�gitos
    return v
  }
  function id( el ){
      return document.getElementById( el );
  }
</script>

<body>
  
  <div class="container">

    <form action="#" method="post">

      <div class="form-group"  style="margin-top:50px;">
        <label>Nome completo</label>
        <input type="text" name="nome" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Telefone</label>
        <input type="text" name="telefone" class="form-control" onkeyup="mascara(this, mcel)" maxlength="15" required>
      </div>

      <div class="form-group">
        <label>E-mail</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Login</label>
        <input type="text" name="login" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Senha</label>
        <input type="text" name="senha" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Empresa (Nome Fantasia)</label>
        <input type="text" name="empresa" class="form-control" required>
      </div>

      <div class="form-group">
        <label>CNPJ</label>
        <input type="text" name="cnpj" id="cnpj" class="form-control" maxlength="18" required>
      </div>

      <div class="form-group" align="center">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
      </div>

    </form>

  </div>

  <script src="assets/js/core/jquery.min.js"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js"></script>
  <script>
    $("#cnpj").on("keyup", function(e){
      $(this).val(
          $(this).val()
          .replace(/\D/g, '')
          .replace(/^(\d{2})(\d{3})?(\d{3})?(\d{4})?(\d{2})?/, "$1.$2.$3/$4-$5"));
    });
  </script>

</body>

</html>
