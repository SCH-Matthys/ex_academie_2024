<header>
    <nav>
        <ul>
            <li><a href="/php%20academie%202024/index.php">Accueil</a></li>
            <li><a href="/php%20academie%202024/app/navigation/bestiary.php">Bestiaire</a></li>
            <li><a href="/php%20academie%202024/app/navigation/codex.php">Codex</a></li>
            <?php 
                if(isset($_SESSION["user_id"])){
                    echo "<li><a href='/php%20academie%202024/app/actions/add.php'>Ajouter une créature</a></li>";
                    echo "<li><a href=''>Ajouter un sort</a></li>";
                }
                if(!isset($_SESSION["user_id"])){
                    echo "<li><a href='/php%20academie%202024/app/authentification/login.php'>Se connecter</a></li>";
                }
                if(isset($_SESSION["user_id"])){
                    echo "<li><a href='/php%20academie%202024/app/authentification/logout.php'>Se deconnecter</a></li>";
                }
            ?>
        </ul>
    </nav>
</header>