<?php
    include("./../../app/include/environnement.php");
    if(isset($_POST["username"]) && isset($_POST["password"])){
        $username = htmlspecialchars(trim(strtolower($_POST["username"])));
        $password = htmlspecialchars(trim($_POST["password"]));
        $cryptedPassword = sha1("Monstrueuse Creature" . $password);
        // $request = $bdd->prepare("  SELECT * 
                                    // -- FROM users
                                    // -- WHERE name = ?
        // -- ");
        $request = $bdd->prepare("  SELECT * 
                                    FROM users AS u
                                    LEFT JOIN users_elements ON u.id = users_elements.user_id
                                    LEFT JOIN elements ON users_elements.element_id = elements.id
                                    WHERE u.name = ?
        ");
        $request->execute([$username]);
        $elements = [];
        while($data = $request->fetch()){
            array_push($elements, $data["name"]);
            if($cryptedPassword == $data["password"]){
                $_SESSION["user_id"] = $data["user_id"];
                $_SESSION["role"] = $data["role"];
                // var_dump($_SESSION);
                // var_dump($data);
                // var_dump($data["name"]);
            }else{
                header("Location:/php%20academie%202024/app/authentification/login.php?loginError=1");
            };
        };
        $_SESSION["elements"] = $elements;
        // var_dump($data);
        // var_dump($elements);
        // var_dump($data["id"]);
        // var_dump($_SESSION);
        header("Location:/php%20academie%202024/index.php");
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
    <?php  include("./../../app/include/header.php") ?>
    <main id="mainLogin">
        <form action="login.php" method="POST">
            <?php
                if((isset($_GET["registerSuccess"])) && ($_GET["registerSuccess"] == 1)){
                    echo "<p class='valid'>Votre compte à bien été créé.</p>";
                };
                if((isset($_GET["loginError"])) && ($_GET["loginError"] == 1)){
                    echo "<p class='error'>Données invalides.</p>";
                };
            ?>
            <div>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <a href="/php%20academie%202024/app/authentification/register.php">Pas encore inscrit ?</a>
            <button>se connecter</button>
        </form>
    </main>
</body>
</html>