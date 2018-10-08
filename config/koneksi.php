<?php
    try {
        $connect = new PDO('mysql:host=localhost;dbname=silogter','root','');
        //$connect = new PDO('mysql:host=localhost;dbname=silogter', "root", "");
        $connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>