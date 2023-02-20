<?php

use App\Database\Database;

//Requiring the autoloader
require '../../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD']=='POST') {
    // Create new object Dvd/Book/Furniture depending on what the user selected
    $className = $_POST['selector'];
    $classPath = "App\Product\Types\\".$className."\\".$className;

    $type = new $classPath;
    $type->data = $_POST;
    $type->type = $className;
    $errors = $type->validateData();

    // Check if there is any errors
    $errors['success'] = "";
    foreach ($errors as $key => $value) {
        if (!(empty($value) && 0 !== $value)) {
            $errors['type'] = $type->type;
            $errors['success'] = "false";
        }
    }

    // In case of no errors -> add new product to the database
    if ($errors['success'] != "false") {
        $errors['success'] = "true";
        $database = new Database();
        $database->create($type);
    }

    // Returing the Errors to AJAX call
    echo json_encode($errors);
}

?>