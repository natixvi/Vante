<?php
    session_start();
    require_once("connection.php");
    require('functions.php');
?>
<?php
    clear_cart();
    header('Location: showcart.php');
 ?>
