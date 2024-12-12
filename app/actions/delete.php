<?php 
    include("./../../app/include/environnement.php");
    $request = $bdd->prepare("  DELETE FROM creatures WHERE id = ? ");
    $request->execute([$_GET["id"]]);
    header("Location:/php%20academie%202024/app/navigation/bestiary?deleteSuccess=1");