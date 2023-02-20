<?php

namespace App\Product\Types\Dvd;
use App\Product\Product;

class Dvd extends Product {

    public array $errors;

    public function validateValue() {
        if(!$this->data['size']) {
            return "Size's not provided";
        }

        if($this->data['price'] <= 0) {
            return "Size's invalid";
        }

        $this->value = "Size: ".$this->data['size'] ." MB";
        return "";
    }

    public function addError ($key, $val) {
        $this->errors[$key] = $val;
    }

    public function validateData() {
        // Calling all functions to validate data of a DVD product
        $this->addError('sku',parent::validateSku());
        $this->addError('name',parent::validateName());
        $this->addError('price',parent::validatePrice());
        $this->addError('value',$this->validateValue());

        return $this->errors;
    }
}

?>