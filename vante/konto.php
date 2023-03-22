<?php
 session_start();
 require("header.php");
 require("connection.php");
 require('functions.php');
 require("menu.php");
?>
<main>
  <div id="kontoContainer">

      <div class="konto" id="logowanie">
        <h3>Logowanie</h3>
              <form method="post" action="login.php">
                  <label>Login:</label><input class="pole" type="text" name="login" placeholder="Login"><br>
                  <label>Hasło:</label><input class="pole" type="password" name="pass" placeholder="Hasło"><br>
                  <input class="button" type="submit" value="Zaloguj"><br>

            				<?php
            					if (isset($_SESSION['bad_attempt'])) {
            						echo '<div style="color:red;">Niepoprawny login lub hasło!</div>';
            						unset($_SESSION['bad_attempt']);
            					}
            			 ?>

              </form>
        </div>

        <div class="konto" id="rejestracja">
            <h3>Rejestracja</h3>
              <form method="post" action="rejestracja.php">

                <label >Nazwa użytkownika:</label><input class="pole" type="text" name="nick" placeholder="Nazwa użytkownika"/><br>
                <?php
                    if(isset($_SESSION['e_nick'])){
                      echo '<div style="color:red;">'.$_SESSION['e_nick'].'</div>';
                      unset( $_SESSION['e_nick']);
                    }
                ?>
                <label>Adres e-mail:</label><input class="pole" type="text" name="email" placeholder="Adres email"/><br>
                <?php
                    if(isset($_SESSION['e_email'])){
                      echo '<div  style="color:red;">'.$_SESSION['e_email'].'</div>';
                      unset($_SESSION['e_email']);
                    }
                 ?>
                <label>Twoje hasło:</label><input class="pole" type="password" name="haslo1" placeholder="Hasło" /><br>
                <?php
                    if(isset($_SESSION['e_haslo'])){
                      echo '<div style="color:red;">'.$_SESSION['e_haslo'].'</div>';
                      unset($_SESSION['e_haslo']);
                    }
                 ?>
                <label>Powtórz hasło:</label><input class="pole" type="password" name="haslo2" placeholder="Powtórz hasło"/><br>
                <input class="button" type="submit" name="rejestracja" value="Zarejestruj" placeholder="Zarejestruj"><br><br>
              </form>
              <?php
                  if(isset($_SESSION['udanarejestracja'])){
                    echo '<div  style="color:red;">'.$_SESSION['udanarejestracja'].'</div>';
                    unset($_SESSION['udanarejestracja']);
                  }
              ?>

        </div>

      </div>
    <div style="clear:both;"></div>
    <br><br>
</main>
 <?php require("footer.html") ?>
