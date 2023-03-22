<?php
    try{
    $pdo = new PDO("mysql:host=localhost;port=3306;dbname=vante;charset=utf8", 'root','Stronka#95',[
        PDO::ATTR_EMULATE_PREPARES => false,
    		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    	]);

    }
    catch (PDOException $error) {

    	echo $error->getMessage();
    	exit('Database error');

    }
?>
