<?php
    session_start();
    require_once("connection.php");
    require('functions.php');

    removeAllFromCart($_GET['id']);
    header('Location: showcart.php');
 ?>
