<?php session_start(); ?>
<?php  require_once("header.php") ?>
<?php  require_once("connection.php") ?>
<?php require_once('functions.php');?>
<?php require_once("menu.php") ?>

<main>
<?php if(!isset($_SESSION['id'])){ ?>

<div class="noUserCartContainer">

  <div class="noUserCart">
      <h1>Jeśli chcesz korzystać z koszyka musisz się zalogować.</h1>
      <a href="konto.php">Strona logowania</a>
  <div>

</div>

<?php
}
else{
    $content = getProducts();
    if(!$content){
?>
  <div class="noUserCartContainer">

    <div class="noUserCart">
        <h1>Twój koszyk jest pusty.</h1>
    <div>

  </div>
<?php
    }
    else{
?>
  <div id="cart_container">
      <h1>Koszyk produktów</h1>
      <div id="cart_menu">

				<div class="cart_desc">
					<p>Artykuł </p>
				</div>
				<div class="cart_desc">
					<p></p>
				</div>
				<div class="cart_desc">
					<p>Ilość</p>
				</div>
				<div class="cart_desc">
					<p>Cena</p>
				</div>
        <div class="cart_desc">
          <p></p>
        </div>
			</div>
    <div style="clear:both"></div>
        <?php

          $sum = 0;

          foreach($content as $product){
            echo '<div id="item_cart">';
            $price = $product['price'];
            $quantity = $product['quantity'];
            $name = $product['name'];
            $total = $quantity * $price;
            $id= $product['id_product'];
            $sum+=$total;
            $plus =  "<a href='addToCart.php?id=$id'>+</a>";
            $minus = "<a href='remFromCart.php?id=$id'>-</a>";
            $removeall = "<a href='remAllFromCart.php?id=$id'>Usuń</a>";
            $images = getProductPictures($id);
            if(!empty($images)){
              $image = $images[0];
            }
            else{
              $image = 'no-photo.jpg';
            }
        ?>

            <div class="cart_desc">
    				      <img src='images/mini/<?php echo $image;?>'>
    				</div>
    				<div class="cart_desc">
    					<p><?php echo $name; ?></p>
    				</div>
    				<div class="cart_desc">
    					<p><?php echo $quantity."&nbsp&nbsp"; echo $plus."&nbsp&nbsp"; echo $minus; ?></p>
    				</div>
    				<div class="cart_desc">
    					<p><?php echo $price; ?> zł</p>
    				</div>
    				<div class="cart_desc">
    						<p><?php echo $removeall; ?></p>
    				</div>
            </div>
            <div style="clear:both"></div>
        <?php
          }
        ?>
        <div style="clear:both"></div>
        <div id="cart_summary">

          <div class="cart_summary_desc"  id="nocartbutton">
              <?php $clear = "<a href='remCart.php'>Wyczyść koszyk</a>";?>
              <p><?php echo $clear; ?><p>
              <h2>Wartość koszyka <?php echo $sum;?> zł</h2>
          </div>

  			</div>

        <div style="clear:both"></div>
        <div  id="cartbutton">
            <a href='order.php'>Złóż zamówienie</a>
        </div>

			</div>

<?php
    }
?>
<?php
}
?>
<div style="clear:both"></div>
<br><br><br><br>
</main>

<?php require("footer.html");?>
