<?php

    session_start();

    include_once("db_connection.php");
    include_once("url.php");

    $query = "SELECT * FROM contacts";

    $stmt = $connection->prepare($query);
    $stmt -> execute();
    $contacts = $stmt->fetchAll();
    
?>