<?php
  session_start();
  require('connection.php');
  require_once('functions.php');

  if (!isset($_SESSION['user'])) {
      if (isset($_POST['login'])) {

      $login = filter_input(INPUT_POST, 'login');
      $password = filter_input(INPUT_POST, 'pass');

      $stmt= $pdo->prepare('SELECT id_user, username, password FROM users WHERE username =:login');
      $stmt->bindValue(':login', $login, PDO::PARAM_STR);
      $stmt->execute();
      $row = $stmt->fetch();

      if($row  && password_verify($password, $row['password'])){
        $_SESSION['id'] = random_session_id();
        $_SESSION['user'] = $row['username'];
  			unset($_SESSION['bad_attempt']);
        header('Location: index.php');
      }
      else{
        $_SESSION['bad_attempt'] = true;
  			header('Location: konto.php');
  			exit();
      }
  }

  else {
  		header('Location: konto.php');
  		exit();
	}

}
else{
  header('Location: index.php');
  exit();
}

?>
