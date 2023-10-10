    <nav>
        <div class="nav-left"><img id="logo" src="https://cdn-icons-png.flaticon.com/256/3523/3523319.png">
        <!-- <h1 id="name">VOISINOUS</h1> -->
            <a href="accueil.php"><button class="greyBtn">ACCUEIL</button></a>
            <a href="searchGroup.php"><button class="greyBtn">RECHERCHE</button></a>
        </div>
        <div class="nav-right">
            <?php if(empty($_SESSION['pseudo'])) {
               echo "<div id='notLogged'><a href='./signIn.php'>SE CONNECTER</a> <a href='./signUp.php'>S'INSCRIRE</a></div>";
            } else {
               echo "<button class='redBtn'>MON PROFIL</button>";
            }
            ?>
        </div>
    </nav>