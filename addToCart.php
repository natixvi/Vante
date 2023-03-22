<?php
    session_start();
    require_once("connection.php");
    require('functions.php');
?>
<?php
    addProduct($_GET['id']);
    header('Location: showcart.php');
 ?>
