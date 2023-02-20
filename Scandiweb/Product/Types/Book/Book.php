<?php

namespace App\Product\Types\Book;
use App\Product\Product;

class Book extends Product {

    public array $errors;

    public function validateValue() {
        if(!$this->data['weight']) {
            return "Weight's not provided";
        }

        if($this->data['weight'] <= 0) {
            return "Weight's invalid";
        }

        $this->value = "Weight: ".$this->data['weight'] ." KG";
        return "";
    }

    public function addError ($key, $val) {
        $this->errors[$key] = $val;
    }

    public function validateData() {
        // Calling all functions to validate data of a book product
        $this->addError('sku',parent::validateSku());
        $this->addError('name',parent::validateName());
        $this->addError('price',parent::validatePrice());
        $this->addError('value',$this->validateValue());

        return $this->errors;
    }
}

?>