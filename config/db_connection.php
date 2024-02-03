<?php
    $host = "localhost";
    $dbname = "agenda";
    $user = "root";
    $password = "Root*3306";

    try{
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

        //ativar modo de erro
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $exception) {
        $error = $exception->getMessage();
        echo "Error: $error";
    }
?>