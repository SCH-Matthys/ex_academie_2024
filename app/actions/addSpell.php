<?php 
    include("./../../app/include/environnement.php");
    if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_FILES["image"]) && isset($_POST["element"])){
        $name = htmlspecialchars(trim(strtolower($_POST["name"])));
        $description = htmlspecialchars(trim($_POST["description"]));
        $element = htmlspecialchars(trim(strtolower($_POST["element"])));
        // var_dump($_FILES["image"]["name"],$_FILES["image"]["type"],$_FILES["image"]["tmp_name"],pathinfo($_FILES["image"]["name"]));
        $imageInfo = pathinfo($_FILES["image"]["name"]);
        $imageName = $imageInfo["filename"];
        $imageExtension = $imageInfo["extension"];
        $authorizedExtension = ["jpg","jpeg","png","webp","svg"];
        if(in_array($imageExtension,$authorizedExtension)){
            $image = $imageName . time() . rand(1,1000) . "." . $imageExtension;
            move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/images/upload/spells/".$image);
        }
        $request = $bdd->prepare("  INSERT INTO spells(name,description,image,user_id,element_name)
                                    VALUES(:name,:description,:image,:user_id,:element_name)
        ");
        $request->execute([
            "name"          => $name,
            "description"   => $description,
            "image"         => $image,
            "user_id"       => $_SESSION["user_id"],
            "element_name"  => $element
        ]);
        header("Location:/php%20academie%202024/app/navigation/codex.php");
    }else{
        echo "non";
        var_dump($_POST);
        var_dump($_SESSION["user_id"]);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Sort</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
    <?php include("./../../app/include/header.php") ?>
    <main id="mainAddSpell">
        <?php
            if($_SESSION["user_id"]){
        ?>
        <form action="addSpell.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Spell name :</label>
                <input type="text" name="name" id="name" required>
            </div>
            <label for="description">Spell description :</label>
            <textarea name="description" id="description" required></textarea>
            <label for="image">Spell image :</label>
            <input type="file" name="image" id="image" required>
            <div>
                <label for="element">Spell element :</label>
                <select name="element" id="element" required>
                    <?php 
                        foreach ($_SESSION["elements"] as $element) {
                            echo "<option value='" . htmlspecialchars($element) . "'>" . htmlspecialchars($element) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <button>Créer</button>
        </form>
        <?php
            }else{
                echo "<p class='error'>Vous devez être connecté pour cela.</p>";
            };
        ?>
    </main>
</body>
</html>