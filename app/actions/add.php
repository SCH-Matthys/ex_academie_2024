<?php 
    include("./../../app/include/environnement.php");
    $requestType = $bdd->prepare("  SELECT name
                                    FROM type
    ");
    $requestType->execute([]);
    if(isset($_POST["name"]) && isset($_POST["description"]) && isset($_FILES["image"]) && isset($_POST["type"])){
        $name = htmlspecialchars(trim(strtolower($_POST["name"])));
        $description = htmlspecialchars(trim($_POST["description"]));
        $type = htmlspecialchars(trim(strtolower($_POST["type"])));
        // var_dump($_FILES["image"]["name"],$_FILES["image"]["type"],$_FILES["image"]["tmp_name"],pathinfo($_FILES["image"]["name"]));
        $imageInfo = pathinfo($_FILES["image"]["name"]);
        $imageName = $imageInfo["filename"];
        $imageExtension = $imageInfo["extension"];
        $authorizedExtension = ["jpg","jpeg","png","webp","svg"];
        if(in_array($imageExtension,$authorizedExtension)){
            $image = $imageName . time() . rand(1,1000) . "." . $imageExtension;
            move_uploaded_file($_FILES["image"]["tmp_name"],"../../assets/images/upload/".$image);
        }
        $request = $bdd->prepare("  INSERT INTO creatures(name,description,image,type,user_id)
                                    VALUES(:name,:description,:image,:type,:user_id)
        ");
        $request->execute([
            "name"          => $name,
            "description"   => $description,
            "image"         => $image,
            "type"          => $type,
            "user_id"       => $_SESSION["user_id"]
        ]);
        header("Location:/php%20academie%202024/app/navigation/bestiary.php");
    }else{
        echo "non";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Creature</title>
    <link rel="stylesheet" href="./../../assets/css/style.css">
</head>
<body>
<?php include("./../../app/include/header.php") ?>
    <main id="mainAdd">
        <?php 
            if(isset($_SESSION["user_id"])){ 
        ?>
        <form action="add.php" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name">Creature name :</label>
                <input type="text" name="name" id="name" required>
            </div>
            <label for="description">Creature description :</label>
            <textarea name="description" id="description" required></textarea>
            <label for="image">Creature image :</label>
            <input type="file" name="image" id="image" required>
            <div>
                <label for="type">Creature type :</label>
                <select name="type" id="type" required>
                    <?php 
                        while( $typeData = $requestType->fetch()){
                            echo "<option value='". $typeData['name'] . "'>" . $typeData['name'] . "</option>";
                        };
                    ?>
                </select>
            </div>
            <button>Créer</button>
        </form>
        <?php 
            }else{
                echo "<p class='error'>Vous devez être conncté pour cela.</p>";
            }
        ?>
        
    </main>
</body>
</html>