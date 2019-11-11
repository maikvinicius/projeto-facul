<?php
include 'conexao.php';
date_default_timezone_set('America/Sao_Paulo');
header("Content-Type: application/json; charset=UTF-8");
$post = json_decode(file_get_contents('php://input'));

if($post->local == "nova_etapa") {

  $antigo = str_replace("_","", $post->antigo);
  $novo = str_replace("_","", $post->novo);

  $usuario = $post->usuario;
  $descricao =$post->descricao;

  $token = $post->token;

  if($antigo != "InicioBoard"){

    $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND inicial = '1' AND status = '1'; ";
    $result = mysqli_query($conn, $consulta);
    $etapa = mysqli_fetch_assoc($result);

    if($etapa['nome'] == $novo){
      $sql = "UPDATE Venda SET token = '{$token}' WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$post->venda}';";
      $sucesso = mysqli_query($conn, $sql);
    }

    $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND nome ='{$antigo}' AND status = '1'; ";
    $result = mysqli_query($conn, $consulta);
    $etapa = mysqli_fetch_assoc($result);

    if(count($etapa) > 0){

      $consulta = "SELECT * FROM Item_Etapa 
                WHERE empresa = '{$_SESSION["empresa"]}' AND FK_Etapa_Codigo ='{$etapa['codigo']}' AND FK_Venda_Codigo = '{$post->venda}'; ";
      $result = mysqli_query($conn, $consulta);
      $row = mysqli_fetch_assoc($result);

      if(count($row) > 0){
        $dataFinal = date("Y-m-d H:i:s");
        $sql = "UPDATE Item_Etapa SET data_final = '{$dataFinal}', FK_Usuario_Codigo = '{$usuario}'
                WHERE empresa = '{$_SESSION["empresa"]}' AND FK_Etapa_Codigo ='{$etapa['codigo']}' AND FK_Venda_Codigo = '{$post->venda}';";
        $sucesso = mysqli_query($conn, $sql);

        $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND nome ='{$novo}' AND status = '1'; ";
        $resultEtapaNova = mysqli_query($conn, $consulta);
        $etapaNova = mysqli_fetch_assoc($resultEtapaNova);

        $sql = "INSERT INTO Item_Etapa (descricao, FK_Usuario_Codigo, FK_Etapa_Codigo, FK_Venda_Codigo, empresa)
                VALUES ('{$descricao}', '{$usuario}', '{$etapaNova['codigo']}', '{$post->venda}', '{$_SESSION["empresa"]}')";
        $sucesso = mysqli_query($conn, $sql);

        if($etapaNova['ultima']==1){
          $sql = "UPDATE Venda SET status = '0'
                WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$post->venda}';";
          $sucesso = mysqli_query($conn, $sql);

          $consulta = "SELECT * FROM Item_Etapa WHERE empresa = '{$_SESSION["empresa"]}' ORDER BY codigo DESC LIMIT 1;";
          $resultEtapa = mysqli_query($conn, $consulta);
          $ultima = mysqli_fetch_assoc($resultEtapa);

          $sql = "UPDATE Item_Etapa SET data_final = '{$dataFinal}'
                WHERE empresa = '{$_SESSION["empresa"]}' AND codigo = '{$ultima["codigo"]}';";
          $sucesso = mysqli_query($conn, $sql);
        }

      } else {
        $sql = "INSERT INTO Item_Etapa (descricao, FK_Usuario_Codigo, FK_Etapa_Codigo, FK_Venda_Codigo, empresa)
                VALUES ('{$descricao}', '{$usuario}', '{$etapa['codigo']}', '{$post->venda}', '{$_SESSION["empresa"]}')";
        $sucesso = mysqli_query($conn, $sql);
      }

    }

  } else {

    $consulta = "SELECT * FROM Etapa WHERE empresa = '{$_SESSION["empresa"]}' AND nome ='{$novo}' AND status = '1'; ";
    $result = mysqli_query($conn, $consulta);
    $etapa = mysqli_fetch_assoc($result);

    if(count($etapa) > 0){

      $consulta = "SELECT * FROM Item_Etapa 
                WHERE empresa = '{$_SESSION["empresa"]}' AND FK_Etapa_Codigo ='{$etapa['codigo']}' AND FK_Venda_Codigo = '{$post->venda}'; ";
      $result = mysqli_query($conn, $consulta);
      $row = mysqli_fetch_assoc($result);

      if(count($row) > 0){
        $dataFinal = date("Y-m-d H:i:s");
        $sql = "UPDATE Item_Etapa SET data_final = '{$dataFinal}', descricao = '{$descricao}', FK_Usuario_Codigo = '{$usuario}'
                WHERE empresa = '{$_SESSION["empresa"]}' AND FK_Etapa_Codigo ='{$etapa['codigo']}' AND FK_Venda_Codigo = '{$post->venda}';";
        $sucesso = mysqli_query($conn, $sql);
      } else {
        $sql = "INSERT INTO Item_Etapa (descricao, FK_Usuario_Codigo, FK_Etapa_Codigo, FK_Venda_Codigo, empresa)
                VALUES ('{$descricao}', '{$usuario}', '{$etapa['codigo']}', '{$post->venda}', '{$_SESSION["empresa"]}')";
        $sucesso = mysqli_query($conn, $sql);
      }

    }

  }

  $response = array(
    "success" => true,
    "message" => "atualizado com sucesso"
  );

}

echo json_encode($response);
