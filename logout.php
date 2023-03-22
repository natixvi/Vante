<?php
session_start();
require_once("connection.php");
require('functions.php');
    clear_cart();
    unset($_SESSION['id']);
    unset($_SESSION['user']);
session_destroy();
header('Location: index.php');

 ?>
