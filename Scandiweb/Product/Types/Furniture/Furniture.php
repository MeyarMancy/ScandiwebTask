<?php

namespace App\Product\Types\Furniture;
use App\Product\Product;

class Furniture extends Product {

    public array $errors;

    public function validateValue() {
        if(!$this->data['height'] || !$this->data['width'] || !$this->data['length'] ) {
            return "Dimensions are not provided";
        }

        if($this->data['height'] <= 0 || $this->data['width'] <= 0 || $this->data['length'] <= 0) {
            return "Dimensions are invalid";
        }

        $this->value = "Dimension: " .$this->data['height']."x".$this->data['width']."x".$this->data['length'];
        return "";
    }

    public function addError ($key, $val) {
        $this->errors[$key] = $val;
    }

    public function validateData() {
        // Calling all functions to validate data of a furniture product
        $this->addError('sku',parent::validateSku());
        $this->addError('name',parent::validateName());
        $this->addError('price',parent::validatePrice());
        $this->addError('value',$this->validateValue());

        return $this->errors;
    }
}

?>