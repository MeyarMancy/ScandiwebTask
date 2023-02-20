<?php
 
namespace App\Product;
use App\Database\Database;

abstract class Product {

    public string $sku;
    public string $name;
    public float $price;
    public string $type;
    public string $value;
    
    public array $data;

    // All functions for validating product's data
    public function validateSku() {
        if(!$this->data['sku'] || empty(trim($this->data['sku']))) {
            return "SKU's not provided";
        }

        $database = new Database();
        if(!$database->check($this->data['sku'])) {
            return "SKU already exist";
        }

        $this->sku = $this->data['sku'];
        return "";
    }

    public function validateName() {
        if(!$this->data['name'] || empty(trim($this->data['name']))) {
            return "Name's not provided";
        }

        $this->name = $this->data['name'];
        return "";
    }

    public function validatePrice() {
        if(!$this->data['price']) {
            return "Price's not provided";
        }

        if($this->data['price'] <= 0) {
            return "Price's invalid";
        }

        $this->price = $this->data['price'];
        return "";
    }

    public function validateType() {
        if(!$this->data['type']) {
            return "Type's not provided";
        }

        $types = ['Dvd', 'Book', 'Furniture'];
        if(!in_array($this->data['type'],$types)) {
            return "Type's invalid";
        }

        $this->type = $this->data['type'];
        return "";
    }

    // Abstract function to be declared depending on each product type
    abstract protected function validateValue();
    
}

?>