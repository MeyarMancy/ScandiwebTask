<?php

namespace App\Database;
use App\Product\Product;
use mysqli;

class Database {

    private string $servername = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $dataBase = 'Products_Database';
    private string $dataTable = 'Products';
    private $conn;

    public function __construct() {
        // Connect to the database
        if (!isset($this->conn)) {
            $conn = new mysqli($this->servername, $this->username, $this->password);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        }
        // echo "Connected successfully <br>";
        $this->conn = $conn;
    }

    public function __destruct() {
        // Close the connection
        $this->conn->close();
    }

    public function createTable() {
        // Creating a Database and a Table for the products if it does NOT exist
        $sql = "CREATE DATABASE IF NOT EXISTS $this->dataBase";
        if ($this->conn->query($sql) === FALSE) {
            die("Error creating database: " . $this->conn->error);
        }
        // echo "Database created successfully <br>";

        $sql = "CREATE TABLE IF NOT EXISTS $this->dataBase.$this->dataTable (
            `sku` varchar(255) COLLATE utf8_bin NOT NULL PRIMARY KEY,
            `name` varchar(255) COLLATE utf8_bin NOT NULL,
            `price` float NOT NULL,
            `type` varchar(255) COLLATE utf8_bin NOT NULL,
            `value` varchar(255) COLLATE utf8_bin NOT NULL 
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;";
        if ($this->conn->query($sql) === FALSE) {
            die("Error creating table: " . $this->conn->error);
        }
        // echo "Table created successfully <br>";
    }

    public function read() {
        // Reading all data from the database
        $sql = "SELECT * FROM $this->dataBase.$this->dataTable ORDER BY sku";
        $result = $this->conn->query($sql);
        if (!$result) {
            die("Error reading from table: " .$this->conn->error);
        }
        // echo "Data read successfully <br>";
        return $result;
    }

    public function check($sku) {
        // Checking if the SKU exist or not
        $sql = "SELECT * FROM $this->dataBase.$this->dataTable WHERE sku='$sku'";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return FALSE;
        }
        // echo "SKU not found <br>";
        return TRUE;
    }

    public function create(Product $product) {
        // Creating a record for the new product
        $sql = "INSERT INTO $this->dataBase.$this->dataTable (sku, name, price, type, value)
            VALUES ('$product->sku', '$product->name', '$product->price', '$product->type', '$product->value')";
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            die("Error creating data: " .$this->conn->error);
        }
        // echo "Data Created successfully <br>";
        return $result;
    }

    public function delete($sku) {
        // Deleting product based on SKU
        $sql = "DELETE FROM $this->dataBase.$this->dataTable WHERE sku='$sku'";
        $result = $this->conn->query($sql);
        if ($result === FALSE) {
            die("Error deleting data: " .$this->conn->error);
        }
        // echo "Data deleted successfully <br>";
        return $result;
    }
}

?>