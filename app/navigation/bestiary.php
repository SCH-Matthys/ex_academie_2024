<?php 
    include("./../../app/include/environnement.php");
    $request = $bdd->prepare("  SELECT *
                                FROM creatures
                                -- INNER JOIN users ON creatures.user_id = users.name
    ");
    $request->execute([]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestiaire</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
<?php include("./../../app/include/header.php") ?>
    <main id="mainBestiary">
        <?php
            while($data = $request->fetch()):
        ?>
        <article>
            <img src="/php%20academie%202024/assets/images/upload/<?= $data["image"] ?>" alt="image <?= $data["name"] ?>">
            <h2><?= $data["name"] ?></h2>
            <p>Type : <?= $data["type"] ?></p>
            <p><?= $data["description"] ?></p>
            <p>Ajouté par : <?= $data["user_id"] ?></p>
            <?php 
                if(isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $data["user_id"] || isset($_SESSION["role"]) && $_SESSION["role"] == "admin"){
                    echo "
                            <div>
                                <a href='/php%20academie%202024/app/actions/edit.php?id=".$data["id"]."'>Modifier</a>
                                <a href='/php%20academie%202024/app/actions/delete.php?id=".$data["id"]."'>Supprimer</a>
                            </div>
                        ";
                };  
            ?>
        </article>
        <?php
            endwhile;
        ?>
    </main>
</body>
</html>