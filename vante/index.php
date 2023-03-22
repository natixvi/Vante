<?php session_start() ?>
<?php require("header.php") ?>
<?php require("connection.php")  ?>
<?php require('functions.php');?>
<?php require("menu.php") ?>

  <main>

    <?php
     if(isset($_GET['cat_id'])){
       $category_id = $_GET['cat_id'];
     }
     else{
       $category_id = null;
     }
      showCategory($category_id);
    ?>

  </main>
<?php require("footer.html")?>
