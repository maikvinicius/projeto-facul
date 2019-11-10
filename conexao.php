<?php
  session_start();

  // Desativa toda exibição de erros
  error_reporting(1);

  // Exibe todos os erros PHP (see changelog)
  error_reporting(E_ALL);

  // Exibe todos os erros PHP
  error_reporting(-1);

  // Mesmo que error_reporting(E_ALL);
  ini_set('error_reporting', E_ALL);

  $servername = "localhost";
  $username = "root";
  $password = "root";
  $dbname = "crm";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
      exit;
  }

  if(isset($_SESSION["logado"])){
    if(!$_SESSION["logado"]){
      session_unset();
      header('Location: index.php');
    }
  }else{
    session_unset();
    header('Location: index.php');
  }

  function havePermission($conn, $page, $type) {
    $consulta = "SELECT * FROM Permissao WHERE FK_Usuario_codigo ='{$_SESSION["codigo"]}';";
    $result = mysqli_query($conn, $consulta);
    $rowPermissao = mysqli_fetch_assoc($result);

    // types
    // name_visualizar
    // name_cadastrar
    // name_editar
    // name_desativar

    if(unserialize($rowPermissao[$page])[$type] == 0){
      header('Location: sem_permissao.php');
    }

  }