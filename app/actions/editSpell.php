<?php 
    include("./../../app/include/environnement.php");
    $requestSpell = $bdd->prepare("  SELECT *
                                        FROM spells
                                        WHERE id = ?
    ");
    $requestSpell->execute([$_GET["id"]]);
    $dataSpell = $requestSpell->fetch();

    if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["element"])){
        $name = htmlspecialchars(trim(strtolower($_POST["name"])));
        $description = htmlspecialchars(trim($_POST["description"]));
        $element = htmlspecialchars(trim(strtolower($_POST["element"])));
        $id = htmlspecialchars(trim($_POST["id"]));
        // var_dump($_FILES["image"]["name"],$_FILES["image"]["type"],$_FILES["image"]["tmp_name"],pathinfo($_FILES["image"]["name"]));   
        if($_FILES["image"]['error'] === UPLOAD_ERR_NO_FILE){
            $request = $bdd->prepare("  UPDATE spells
                                        SET name = :name, description = :description, element_name = :element_name
                                        WHERE id = :id
            ");
            $request->execute([
                "name"          => $name,
                "description"   => $description,
                "element_name"  => $element,
                "id"            => $id
            ]);
            header("Location:/php%20academie%202024/app/navigation/codex.php");
            // var_dump($dataSpell);
        }else{
            $imageInfo = pathinfo($_FILES["image"]["name"]);
            $imageName = $imageInfo["filename"];
            $imageExtension = $imageInfo["extension"];
            $authorizedExtension = ["jpg","jpeg","png","webp","svg"];
            if(in_array($imageExtension,$authorizedExtension)){
                $image = $imageName . time() . rand(1,1000) . "." . $imageExtension;
                move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/images/upload/spells/".$image);
            }
            $request = $bdd->prepare("  UPDATE spells
                                    SET name = :name, description = :description, image = :image, element_name = :element_name
                                    WHERE id = :id
            ");
            $request->execute([
                "name"          => $name,
                "description"   => $description,
                "image"         => $image,
                "element_name"  => $element,
                "id"            => $id
            ]);
            header("Location:/php%20academie%202024/app/navigation/codex.php");
            // var_dump($dataSpell);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer Sort</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
<?php include("./../../app/include/header.php") ?>
    <main id="mainEditSpell">
        <?php 
            if(isset($_SESSION["user_id"])){ 
                // var_dump($dataSpell);
        ?>
        <form action="editSpell.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Spell name :</label>
                <input type="text" name="name" id="name" value="<?= $dataSpell["name"] ?>" required>
            </div>
            <label for="description">Spell description :</label>
            <textarea name="description" id="description" required><?= $dataSpell["description"] ?></textarea>
            <label for="image">Spell image :</label>
            <input type="file" name="image" id="image">
            <div>
                <label for="element">Creature type :</label>
                <select name="element" id="element" value="<?= $dataSpell["element_name"] ?>" required>
                    <?php 
                        foreach ($_SESSION["elements"] as $element) {
                            echo "<option value='" . htmlspecialchars($element) . "'>" . htmlspecialchars($element) . "</option>";
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= $dataSpell["id"] ?>">
            <button>Modifier</button>
        </form>
        <?php 
            }else{
                echo "<p class='error'>Vous devez être conncté pour cela.</p>";
            }
        ?>
        
    </main>
</body>
</html>