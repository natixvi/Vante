<?php session_start() ?>
<?php require("header.php"); ?>
<?php require("connection.php");  ?>
<?php require('functions.php');?>
<?php require("menu.php"); ?>
<?php clear_cart() ?>

<main>
  <?php if(!isset($_SESSION['id'])){ header('Location: index.php');}?>

<div id="orderContainer">

  <div id="order">
      <h1>Dziękujemy za złożenie zamówienia w naszym sklepie.</h1>
  <div>

</div>
</main>
<?php require("footer.html")?>
