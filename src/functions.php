<?php

/* reused code from sessions_lab */
class functions
{
    function clean ($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function checkStock ($id, $quantity)
    {
        try {

            require_once '../database/connect.php';

            $sql = "SELECT * FROM warehouse WHERE sku = :id";
            $statement = $connection->prepare($sql);
            $statement->bindValue(':id', $id);
            $statement->execute();

            $item = $statement->fetch(PDO::FETCH_ASSOC);

            $lowerStock = $item["totalStock"] - $_POST['quantity'];

            $product = [
                "sku" => $_GET["id"],
                "totalStock" => $lowerStock
            ];

            $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

            $statement = $connection->prepare($sql);
            $statement->execute($product);

        } catch (PDOException $error) {

            echo $sql . "<br>" . $error->getMessage();

        }
    }
}