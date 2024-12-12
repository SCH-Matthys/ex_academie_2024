<?php 
    include("./../../app/include/environnement.php");
    $requestType = $bdd->prepare("  SELECT name
                                    FROM type
    ");
    $requestType->execute([]);

    $requestCreature = $bdd->prepare("  SELECT *
                                        FROM creatures
                                        WHERE id = ?
    ");
    $requestCreature->execute([$_GET["id"]]);
    $dataCreature = $requestCreature->fetch();

    if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["type"])){
        $name = htmlspecialchars(trim(strtolower($_POST["name"])));
        $description = htmlspecialchars(trim($_POST["description"]));
        $type = htmlspecialchars(trim(strtolower($_POST["type"])));
        $id = htmlspecialchars(trim($_POST["id"]));
        // var_dump($_FILES["image"]["name"],$_FILES["image"]["type"],$_FILES["image"]["tmp_name"],pathinfo($_FILES["image"]["name"]));   
        if($_FILES["image"]['error'] === UPLOAD_ERR_NO_FILE){
            $request = $bdd->prepare("  UPDATE creatures
                                        SET name = :name, description = :description, type = :type
                                        WHERE id = :id
            ");
            $request->execute([
                "name"          => $name,
                "description"   => $description,
                "type"          => $type,
                "id"            => $id
            ]);
            header("Location:/php%20academie%202024/app/navigation/bestiary.php");
        }else{
            $imageInfo = pathinfo($_FILES["image"]["name"]);
            $imageName = $imageInfo["filename"];
            $imageExtension = $imageInfo["extension"];
            $authorizedExtension = ["jpg","jpeg","png","webp","svg"];
            if(in_array($imageExtension,$authorizedExtension)){
                $image = $imageName . time() . rand(1,1000) . "." . $imageExtension;
                move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/images/upload/".$image);
            }
            $request = $bdd->prepare("  UPDATE creatures
                                    SET name = :name, description = :description, image = :image, type = :type
                                    WHERE id = :id
            ");
            $request->execute([
                "name"          => $name,
                "description"   => $description,
                "image"         => $image,
                "type"          => $type,
                "id"            => $id
            ]);
            header("Location:/php%20academie%202024/app/navigation/bestiary.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer Creature</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
<?php include("./../../app/include/header.php") ?>
    <main id="mainEdit">
        <?php 
            if(isset($_SESSION["user_id"])){ 
                // var_dump($dataCreature);
                // var_dump($_FILES);
        ?>
        <form action="edit.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Creature name :</label>
                <input type="text" name="name" id="name" value="<?= $dataCreature["name"] ?>" required>
            </div>
            <label for="description">Creature description :</label>
            <textarea name="description" id="description" required><?= $dataCreature["description"] ?></textarea>
            <label for="image">Creature image :</label>
            <input type="file" name="image" id="image">
            <div>
                <label for="type">Creature type :</label>
                <select name="type" id="type" value="<?= $dataCreature["type"] ?>" required>
                    <?php 
                        while( $typeData = $requestType->fetch()){
                            echo "<option value='". $typeData['name'] . "'>" . $typeData['name'] . "</option>";
                        };
                    ?>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= $dataCreature["id"] ?>">
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