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
        } else if ($data["type"] === "edit"){
            $name = $data["name"];
            $phone = $data["phone"];
            $observations = $data["observations"];
            $id = $data["id"];

            $query = "UPDATE contacts " .
            "SET name = :name, phone = :phone, observations = :observations " .
            "WHERE id = :id";

            $stmt = $connection->prepare($query);

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":phone", $phone);
            $stmt->bindParam(":observations", $observations);
            $stmt->bindParam(":id", $id);

            try{
                $stmt->execute();
                $_SESSION["msg"] = "Contato Editado Com Sucesso!";
            } catch(PDOException $exception){
                $error = $exception->getMessage();
                echo "Error: $error";
            }
        } else if ($data["type"] === "delete"){
            $id = $data["id"];

            $query = "DELETE FROM contacts WHERE id = :id";

            $stmt = $connection->prepare($query);

            $stmt->bindParam(":id", $id);

            try{
                $stmt->execute();
                $_SESSION["msg"] = "Contato Deletado Com Sucesso!";
            } catch(PDOException $exception){
                $error = $exception->getMessage();
                echo "Error: $error";
            }
        }
        header("Location:" . $BASE_URL . "../index.php");
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