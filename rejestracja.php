<?php
  session_start();
  require("connection.php");

  if(isset($_POST['rejestracja'])){
      $walidacja = true;

      $nick = $_POST['nick'];
      if((strlen($nick) < 3) || (strlen($nick) > 20)){
        $walidacja = false;
        $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków!";
        header('Location: konto.php');
      }

      if(ctype_alnum($nick)==false){
          $walidacja = false;
          $_SESSION['e_nick']= "Nick może składać się tylko z liter i cyfr (bez polskich znaków)";
          header('Location: konto.php');
      }

      $email = $_POST['email'];
      $emailB = filter_var($email,FILTER_SANITIZE_EMAIL);
      if((filter_var($emailB,FILTER_VALIDATE_EMAIL) == false) || ($emailB!=$email)){ //1-sprawdza czy email byl walidowany 2- czy email poprawiny sue rozni od przeslanego w formularzu
         $walidacja= false;
         $_SESSION['e_email'] = "Podaj poprawny adres e-mail!";
         header('Location: konto.php');
      }

      $haslo1=$_POST['haslo1'];
      $haslo2=$_POST['haslo2'];

      if((strlen($haslo1) < 8) || (strlen($haslo1) > 20)){
        $walidacja = false;
        $_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków";
        header('Location: konto.php');
      }
      if($haslo1 != $haslo2){
          $walidacja = false;
          $_SESSION['e_haslo'] = "Podane hasła nie są identyczne";
          header('Location: konto.php');
      }
      $haslo_hash = password_hash($haslo1,PASSWORD_DEFAULT); //haszujemy haslo gdy oba sa takie same

      //sprawdzamy czy w bazie nie ma juz takich danych:
      $stmt = $pdo->prepare("SELECT id_user FROM users WHERE email=:email");
      $stmt->bindValue(':email', $email, PDO::PARAM_STR);
      $stmt->execute();

      if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $walidacja = false;
        $_SESSION['e_email'] = "Istnieje już konto z takich adresem e-mail!";
        header('Location: konto.php');
      }

      $stmt = $pdo->prepare("SELECT id_user FROM users WHERE username=:name");
      $stmt->bindValue(':name', $nick, PDO::PARAM_STR);
      $stmt->execute();

      if($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        $walidacja = false;
        $_SESSION['e_nick'] = "Istnieje już użytkownik o takim nicku! Wybierz inny.";
        header('Location: konto.php');
      }

      if($walidacja == true){
            $role = "user";
            $stmt = $pdo->prepare("INSERT INTO users (id_user, username, email, password, role) VALUES(NULL,:username,:email,:password,:role)");
            $stmt->bindValue(':username', $nick, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':password', $haslo_hash, PDO::PARAM_STR);
            $stmt->bindValue(':role', $role, PDO::PARAM_STR);
            $result = $stmt->execute();

            if($result){

                $_SESSION['udanarejestracja'] = "Dziękujemy za założenie konto w naszym sklepie. Teraz możesz się zalogować.";
                header('Location: konto.php');
            }
            else{
                $_SESSION['udanarejestracja'] = "Nie udało się zarejestrować konta!";
                header('Location: konto.php');
            }
        }
        $pdo->closeCursor();

  }

















?>
