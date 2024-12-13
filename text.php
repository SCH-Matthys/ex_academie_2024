<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Page test</h1>
    <form action="text.php" method="POST">
        <div>
            <label for="checkbox1">checkbox 1</label>
            <input type="checkbox" name="checkbox1" id="checkbox1" value="checkbox1">
            <label for="checkbox1">checkbox 2</label>
            <input type="checkbox" name="checkbox2" id="checkbox2" value="checkbox2">
            <label for="checkbox1">checkbox 3</label>
            <input type="checkbox" name="checkbox3" id="checkbox3" value="checkbox3">
            <label for="checkbox1">checkbox 4</label>
            <input type="checkbox" name="checkbox4" id="checkbox4" value="checkbox4">
        </div>
        <button>Envoyer</button>
    </form>
    <?php
        var_dump($_POST);
    ?>
</body>
</html>