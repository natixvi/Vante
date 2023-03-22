<body>
<header>

    <nav class="navbar fixed-top navbar-expand-lg navbar-light menu2">
            <a class="navbar-brand" id="mynav" href="index.php"><img src="images/logo.png" width="30" class="d-inline-blick mr-3 align-bottom" height="30" alt="">Vante</a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

              <ul class="navbar-nav ">

                <li class="nav-item">
                  <a class="nav-link" href="index.php">Strona główna</a>
                </li>

                <?php
                  global $pdo;
                  $stmt = $pdo->prepare("SELECT * FROM categories");
                  $stmt->execute();

                  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

                  $category_id = $row['id_category'];
                  $category_name = $row['name_category'];
                  echo '<li class="nav-item">';
                  echo "<a class='nav-link' href='index.php?cat_id=$category_id'>$category_name</a>";
                  echo "</li>";
                }
                ?>

              </ul>

              <ul class="navbar-nav ml-auto">

                <?php
                
                    if(isset($_SESSION['user'])){

                        echo '<li class="nav-item"><a class="nav-link" href="logout.php"><img src="images/logout.png" class="d-inline-blick"  alt="" title="Wyloguj" height="20">&nbsp;&nbsp;Wyloguj</a></li>';
                    }
                    else{
                        echo '<li class="nav-item"><a class="nav-link" href="konto.php"><img src="images/person.png" class="d-inline-blick"  alt="" title="Konto" height="20">&nbsp;&nbsp;Konto</a></li>';
                    }
               ?>

                <li class="nav-item">
                  <a class="nav-link" href="showcart.php"><img src="images/bag.png" class="d-inline-blick"  alt="" title="Koszyk" height="20">&nbsp;&nbsp;Koszyk</a>
                </li>

              </ul>

            </div>

      </nav>

</header>
<br><br>
