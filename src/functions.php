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

