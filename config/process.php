<?php

    session_start();

    include_once("db_connection.php");
    include_once("url.php");


    $id;
    if(!empty($_GET)){
        //retorna um contato
        $id = $_GET["id"];
    }

    if(!empty($id)){
        $query = "SELECT * FROM contacts WHERE id = :id";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $contact = $stmt->fetch();
    } else {
            //retorna todos os contatos
    $query = "SELECT * FROM contacts";

    $stmt = $connection->prepare($query);
    $stmt -> execute();
    $contacts = $stmt->fetchAll();

    }

?>