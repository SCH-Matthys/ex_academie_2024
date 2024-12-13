<?php 
    include("./../../app/include/environnement.php");
    $request = $bdd->prepare("  DELETE FROM spells WHERE id = ? ");
    $request->execute([$_GET["id"]]);
    header("Location:/php%20academie%202024/app/navigation/codex?deleteSuccess=1");