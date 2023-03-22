<?php
  session_start();
  require_once("connection.php");
  require('functions.php');

  remove($_GET['id']);
  header('Location: showcart.php');
?>
