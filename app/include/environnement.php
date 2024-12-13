<?php
    session_start();
    $bdd = new PDO("mysql:host=localhost;dbname=ex_academie_2024;charset=utf8","root","");
    var_dump($_SESSION);
    