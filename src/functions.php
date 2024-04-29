<?php

/* reused code from sessions_lab */
class Clean
{
    function clean ($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}

// database checks
class CheckStock
{
    public function checkStock ($connection, $id, $num)
    {
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
}

class DecreaseStock
{
    public function decreaseStock ($connection, $id, $num)
    {
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
}

class IncreaseStock
{
    public function increaseStock ($connection, $id, $num)
    {
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
}

class LoginWithDatabase
{
    public function loginWithDatabase ($connection, $email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        if($result>0) {

            $id = $result['id'];
            $_SESSION['Login'] = 'User';
            $_SESSION['email']  = $email;
            $_SESSION['id']     = $id;
            $_SESSION['Active'] = true;
            $_SESSION['cartTotalQuantity'] = 0;

            return true;
        } else {
            return false;
        }
    }
}