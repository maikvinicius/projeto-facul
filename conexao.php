<?php
  session_start();

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
