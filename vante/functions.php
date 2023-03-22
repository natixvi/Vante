<?php

function getProductPictures($id){
  $images = array();
  for($i = 0; $i < 10; $i++){
    $filename = $id."-".$i.".jpg";
    $filepath = "images/clothes/$filename";
    if(file_exists($filepath)){
      $images[] = $filename;
    }
  }
  return $images;
}

function showCategory($category_id = null){
  global $pdo;

  if($category_id){
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = :cid");
    $stmt->bindValue(':cid',$category_id,PDO::PARAM_INT);
    $stmt->execute();
    echo "<div id='container'>";
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        echo "<div>";
        $id = $row['id_product'];

          $images = getProductPictures($id);
          if(!empty($images)){
            $image = $images[0];
          }
          else{
            $image = 'brak.png';
          }

        echo "<a href='showproduct.php?product_id=$id'>";
        echo "<img src='images/clothes/$image'>";
        echo "<p>".$row['name']."";
        echo "</a><br>";
        //cena netto
        echo "PLN ".$row['price']."</p>";
        echo "</div>";
      }
      echo "</div>";
      echo "<br>";
    }

  else{
  ?>
    <br>
    <h1 id="index">W naszej ofercie:</h1>
    <hr id="hr">

  <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
        <li data-target="#carousel" data-slide-to="3"></li>
        <li data-target="#carousel" data-slide-to="4"></li>
      </ol>

      <div class="carousel-inner" role="listbox">

        <div class="carousel-item active">
           <div class="view"><img class="d-block w-100" src="images/clothes/13-0.jpg"
            alt="Bluzki">
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Bluzki</h3>
          </div>
        </div>

        <div class="carousel-item">
          <div class="view"><img class="d-block w-100" src="images/clothes/20-0.jpg"
            alt="Sukienki">
          </div>
            <div class="carousel-caption">
              <h3 class="h3-responsive">Sukienki</h3>
            </div>
        </div>

        <div class="carousel-item">
           <div class="view"><img class="d-block w-100" src="images/clothes/42-0.jpg"
            alt="Kurtki">
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Kurtki</h3>
          </div>
        </div>
        <div class="carousel-item">
           <div class="view"><img class="d-block w-100" src="images/clothes/50-0.jpg"
            alt="Spodnie">
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Spodnie</h3>
          </div>
        </div>
        <div class="carousel-item">
           <div class="view"><img class="d-block w-100" src="images/clothes/59-0.jpg"
            alt="Dodatki">
          </div>
          <div class="carousel-caption">
            <h3 class="h3-responsive">Dodatki</h3>
          </div>
        </div>
      </div>

      <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>

  </div>

    <br><br><br>
  <?php
  }
  }
  ?>

<?php


function addProduct($id){
    global $pdo;

          $session_id = $_SESSION['id'];
          $stmt = $pdo->prepare('SELECT * FROM cart WHERE product_id=:id AND session_id=:sid');
          $stmt->bindValue(':id',$id,PDO::PARAM_INT);
          $stmt->bindValue(':sid',$session_id ,PDO::PARAM_STR);
          $stmt->execute();

          if($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){

              $qty = $row[0]['quantity'] + 1;
              $stmt = $pdo->prepare("UPDATE cart SET quantity=:qty WHERE session_id=:sid AND product_id=:pid");
              $stmt->bindValue(':qty', $qty, PDO::PARAM_INT);
              $stmt->bindValue(':sid', $session_id , PDO::PARAM_STR);
              $stmt->bindValue(':pid', $id, PDO::PARAM_INT);
              $stmt->execute();

          }
          else{
              $stmt = $pdo->prepare("INSERT INTO cart (id, session_id, product_id, quantity) VALUES(null,:sid,:pid,1)");
              $stmt->bindValue(':sid', $session_id , PDO::PARAM_STR);
              $stmt->bindValue(':pid', $id, PDO::PARAM_INT);
              $stmt->execute();
          }
}

function removeAllFromCart($id){
        global $pdo;
        $session_id = $_SESSION['id'];

        $stmt = $pdo->prepare("SELECT * FROM cart WHERE product_id=:id AND session_id=:sid");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':sid',$session_id, PDO::PARAM_STR);
        $stmt->execute();

        if($row = $stmt->fetchAll(PDO::FETCH_ASSOC)){
          $stmt = $pdo->prepare("DELETE FROM cart WHERE product_id=:id AND session_id=:sid");
          $stmt->bindValue(':id', $id, PDO::PARAM_INT);
          $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
          $stmt->execute();
        }

}

function remove($id){
      global $pdo;
      $session_id = $_SESSION['id'];

      $stmt = $pdo->prepare("SELECT * FROM cart WHERE product_id=:id AND session_id=:sid");
      $stmt->bindValue(':id', $id, PDO::PARAM_INT);
      $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
      $stmt->execute();

      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $qty = $row[0]['quantity'];
      $qty--;

      if($qty == 0){
          $stmt = $pdo->prepare("DELETE FROM cart WHERE product_id=:id AND session_id=:sid");
          $stmt->bindValue(':id', $id, PDO::PARAM_INT);
          $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
          $stmt->execute();
      }
      else{
        $stmt = $pdo->prepare("UPDATE cart SET quantity=:qty WHERE product_id=:id AND session_id=:sid");
        $stmt->bindValue(':qty', $qty, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
        $stmt->execute();
      }

}

function clear_cart(){
        global $pdo;
        $session_id = $_SESSION['id'];

        $stmt = $pdo->prepare("DELETE FROM cart WHERE session_id=:sid");
        $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
        $stmt->execute();
}

function getProducts(){
        global $pdo;
        $session_id = $_SESSION['id'];

        $stmt= $pdo->prepare('SELECT p.price,s.quantity,p.name,p.id_product FROM cart s LEFT OUTER JOIN products p ON (s.product_id=p.id_product) WHERE s.session_id=:sid');
        $stmt->bindValue(':sid',$session_id,PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;

}


function random_session_id(){
  $utime = time();
  $id = random_salt(40 - strlen($utime)).$utime;
  return $id;
}

function random_salt($len){
  return random_text($len);
}

//tworzymy randomowy string
function random_text($len){
  $base = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';
  $max = strlen($base) - 1;
  $rstring = '';
  mt_srand((double)microtime()*1000000);
  while(strlen($rstring) < $len){
    $rstring.=$base[mt_rand(0, $max)];
  }
  return $rstring;
}

?>
