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
