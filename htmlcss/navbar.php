    <nav>
        <div class="nav-left"><img id="logo" src="https://cdn-icons-png.flaticon.com/256/3523/3523319.png">
        <!-- <h1 id="name">VOISINOUS</h1> -->
            <a href="accueil.php"><button>ACCUEIL</button></a>
            <a href="searchGroup.php"><button>RECHERCHE</button></a>
        </div>
        <div class="nav-right">
            <?php if(empty($_SESSION['pseudo'])) {
               echo "<a href='/signIn.php'<button>SE CONNECTER</button></a>";
            } else {
               echo "<button>MON PROFIL</button>";
            }
            ?>
        </div>
    </nav>