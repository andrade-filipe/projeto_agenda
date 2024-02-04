<?php

    session_start();

    include_once("db_connection.php");
    include_once("url.php");

    $data = $_POST;

    if(!empty($data)){
        if($data["type"] === "create"){
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];

            $query = "INSERT INTO contacts (name,phone,observations) VALUES (:name, :phone, :observations)";

            $stmt = $connection->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":observations", $observations);

            try{
                $stmt->execute();
                $_SESSION["msg"] = "Contato Criado Com Sucesso!";
            } catch(PDOException $exception){
                $error = $exception->getMessage();
                echo "Error: $error";
            }
        }
    } else {
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
    }

    $connection = null;
?>