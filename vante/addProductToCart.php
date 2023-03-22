<?php
    session_start();
    require_once("connection.php");
    require('functions.php');
?>
<?php
    if(isset($_GET['addProduct']) && isset($_SESSION['id'])){
    	$id_product=$_GET['addProduct'];
    	addProduct($id_product);
      header('Location: showcart.php');
      exit();
    }
    else{
        header('Location: showcart.php');
        exit();
    }

?>
