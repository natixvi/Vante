<?php session_start(); ?>
<?php  require_once("header.php") ?>
<?php  require_once("connection.php") ?>
<?php require_once('functions.php');?>
<?php require_once("menu.php") ?>

<main>
<?php
function showProduct($id){
  global $pdo;
  $stmt = $pdo->prepare("SELECT * FROM products WHERE id_product = :id");
  $stmt->bindValue(':id', $id, PDO::PARAM_INT);
  $stmt->execute();

  echo "<div id='containerProduct'>";

      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            echo "<div id='photoProduct'>";
                foreach (getProductPictures($id) as $image){
                  echo "<a href='images/clothes/$image'>";
                  echo "<img src='images/clothes/$image'>";
                  echo "</a>";
                  echo "<br><br>";
                }
            echo "</div>";

            echo "<div id='descriptionProduct'>";

                $id= $row['id_product'];
                echo "<h2>".$row['name']."</h2>";
                echo $row['description'];
                echo "<br><br>";
                echo "<h3>Cena: ".$row['price']." zł</h3>";
                echo "<a href='addProductToCart.php?addProduct=$id'>Dodaj do koszyka</a>";
                echo "<br><br>";

            echo "</div>";

        }

    echo "</div>";

    echo "<div style='clear:both'></div>";
    echo "<br><br>";
 }

    if(isset($_GET['product_id'])){
      showProduct($_GET['product_id']);
    }
    else{
      header("Location index.php");
    }

?>
</main>
<?php require("footer.html")?>
