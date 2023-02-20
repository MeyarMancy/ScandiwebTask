<?php

use App\Database\Database;

// Requiring the autoloader
require '../vendor/autoload.php';

// Creating new Database if it does NOT exist
$database = new Database();
$database->createTable();

// Heading to the product list page
header("location:../View/List/productList.php");

?>
