<?php 
    include("./../../app/include/environnement.php");
    $request = $bdd->prepare("  SELECT *
                                FROM spells
                                -- INNER JOIN users ON creatures.user_id = users.name
    ");
    $request->execute([]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codex</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
<?php include("./../../app/include/header.php") ?>
    <main id="mainCodex">
        <?php
            while($data = $request->fetch()):
        ?>
        <article>
            <img src="/php%20academie%202024/assets/images/upload/spells/<?= $data["image"] ?>" alt="image <?= $data["name"] ?>">
            <h2><?= $data["name"] ?></h2>
            <p>Element : <?= $data["element_name"] ?></p>
            <p><?= $data["description"] ?></p>
            <p>Ajouté par : <?= $data["user_id"] ?></p>
            <?php 
                if(isset($_SESSION["user_id"]) && in_array($data["element_name"],$_SESSION["elements"]) == $data["user_id"] || isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
                    echo "
                            <div>
                                <a href='/php%20academie%202024/app/actions/editSpell.php?id=".$data["id"]."'>Modifier</a>
                                <a href='/php%20academie%202024/app/actions/deleteSpell.php?id=".$data["id"]."'>Supprimer</a>
                            </div>
                        ";
                };  
            ?>
        </article>
        <?php
            // var_dump($data["element_name"],$_SESSION["elements"]);
            endwhile;
        ?>
    </main>
</body>
</html>