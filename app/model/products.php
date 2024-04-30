<?php

    function getProducts ($connection) {

        try {

            $sql = "SELECT * FROM warehouse";

            $statement = $connection->prepare($sql);
            $statement->execute();

            return $statement->fetchAll();

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function getProductsByCategory ($connection, $productCategory) {

        try {

            $sql = "SELECT * FROM warehouse WHERE productCategory = :productCategory";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':productCategory', $productCategory);
            $statement->execute();

            return $statement->fetchAll();

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function getProductBySKU ($connection, $id) {

        try {
            $sql = "SELECT * FROM warehouse WHERE sku = :id";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();

            return $statement->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }
    }

    function deleteProduct ($connection, $id) {

        try {

            $sql = "DELETE FROM warehouse WHERE sku = :id";
            $statement = $connection->prepare($sql);
            $statement->bindParam(':id', $id);
            $statement->execute();

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function createProduct ($connection, $productName, $productCategory, $productDesc, $productPrice, $totalStock) {

        try {

            $new_product = array (
                "productName" => $productName,
                "productCategory" => $productCategory,
                "productDesc" => $productDesc,
                "productPrice" => $productPrice,
                "totalStock" => $totalStock
            );

            $sql = sprintf("INSERT INTO %s (%s) values (%s)", "warehouse",
                implode(", ", array_keys($new_product)),
                ":" . implode(", :", array_keys($new_product)),
                ":" . implode(", :", array_keys($new_product)),
                ":" . implode(", :", array_keys($new_product)),
                ":" . implode(", :", array_keys($new_product)));

            $statement = $connection->prepare($sql);
            $statement->execute($new_product);

            return $statement->fetchAll();

        } catch (PDOException $error) {

            echo $sql . "<br>" . error->getMessage();

        }

    }

    function updateProduct ($connection, $sku, $productName, $productCategory, $productDesc, $productPrice, $totalStock) {

        try {

            $product = array (
                "sku" => $sku,
                "productName" => $productName,
                "productCategory" => $productCategory,
                "productDesc" => $productDesc,
                "productPrice" => $productPrice,
                "totalStock" => $totalStock
            );

            $sql = "UPDATE users
                            SET sku = :sku,
                                productName = :productName,
                                productCategory = :productCategory,
                                productDesc = :productDesc,
                                productPrice = :productPrice,
                                totalStock = :totalStock
                            WHERE sku = :sku";

            $statement = $connection->prepare($sql);
            $statement->execute($product);

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }

    }

    function decreaseStock ($connection, $id, $num) {

        try {

            $statement = $connection->prepare("SELECT * FROM warehouse WHERE sku = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetch(pdo::FETCH_ASSOC);

            $lessStock = $result["totalStock"] - $num;

            $product = [
                "sku" => $id,
                "totalStock" => $lessStock
            ];

            $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

            $statement = $connection->prepare($sql);
            $statement->execute($product);

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }

    function increaseStock ($connection, $id, $num) {

        try {

            $statement = $connection->prepare("SELECT * FROM warehouse WHERE sku = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetch(pdo::FETCH_ASSOC);

            $moreStock = $result["totalStock"] + $num;

            $product = [
                "sku" => $id,
                "totalStock" => $moreStock
            ];

            $sql = "UPDATE warehouse SET totalStock = :totalStock WHERE sku = :sku";

            $statement = $connection->prepare($sql);
            $statement->execute($product);

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }
    }

    function checkStock ($connection, $id, $num) {

        try {

            $statement = $connection->prepare("SELECT * FROM warehouse WHERE sku = :id");
            $statement->bindParam(":id", $id);
            $statement->execute();
            $result = $statement->fetch(pdo::FETCH_ASSOC);

            if ($result['totalStock'] >= $num) {

                return true;

            } else {

                return false;

            }

        } catch (PDOException $e) {

            echo "Error: " . $e->getMessage();

        }

    }


