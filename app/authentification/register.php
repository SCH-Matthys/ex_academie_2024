<?php
    include("./../../app/include/environnement.php");
    // var_dump($_GET);
    $requestElement = $bdd->prepare("   SELECT name
                                        FROM elements
    ");
    $requestElement->execute([]);
    if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["confirmPassword"])){
        // echo "oui";
        $username = htmlspecialchars(trim(strtolower($_POST["username"])));
        $password = htmlspecialchars(trim($_POST["password"]));
        $confirmPassword = htmlspecialchars(trim($_POST["confirmPassword"]));
        if($password == $confirmPassword){
            $request = $bdd->prepare("  SELECT COUNT(*) AS userValue
                                        FROM users
                                        WHERE name = ?
            ");
            $request->execute([$username]);
            $data = $request->fetch();
            if($data["userValue"] < 1){
                $cryptedPassword = sha1("Monstrueuse Creature" . $password);
                $role = "utilisateur";
                $request = $bdd->prepare("  INSERT INTO users(name,password,role)
                                            VALUES (:name,:password,:role)
                ");
                $request->execute([
                    "name"      =>$username,
                    "password"  =>$cryptedPassword,
                    "role"      =>$role
                ]);
                header("Location:/php%20academie%202024/app/authentification/login.php?registerSuccess=1");
            }else{
                header("Location:/php%20academie%202024/app/authentification/register.php?registerError=2");
            }
        }else{
            header("Location:/php%20academie%202024/app/authentification/register.php?registerError=1");
        }
    }
    // var_dump($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
    <?php  include("./../../app/include/header.php") ?>
    <main id="mainRegister">
        <form action="register.php" method="POST">
            <?php
                if((isset($_GET["registerError"])) && ($_GET["registerError"] == 1)){
                    echo "<p class='error'> Les mots de passe sont differents. </p>";
                };
                if((isset($_GET["registerError"])) && ($_GET["registerError"] == 2)){
                    echo "<p class='error'> Vous avez déjà un compte. </p>";
                };
            ?>
            <div class="divInput">
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="divInput">
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="divInput">
                <label for="confirmPassword">Confirm Password :</label>
                <input type="password" name="confirmPassword" id="confirmPassword" required>
            </div>
            <p>Quel(s) élément(s) maîtrisez-vous ?</p>
            <?php 
                while( $elementData = $requestElement->fetch()){
                    echo "<div class='divCheckbox'>";
                    echo "<label for='".$elementData["name"]."'>".$elementData["name"]." :</label>";
                    echo "<input type='checkbox' name='".$elementData["name"]."' id='".$elementData["name"]."'>";
                    echo "</div>";
                };
            ?>
            <a href="/php%20academie%202024/app/authentification/login.php">Déjà inscrit ?</a>
            <button>S'inscrire</button>
        </form>
    </main>
</body>
</html>