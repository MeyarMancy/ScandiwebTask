/**
 * 
 * Define Global Variables
*/

// Variables of selector section
const select = document.querySelector('select');
const dvd = document.querySelector('#DVDField');
const book = document.querySelector('#BookField');
const furniture = document.querySelector('#FurnitureField');

/**
 * End Global Variables
 * Start Helper Functions
*/

// Validate type selector
function validateType() {
    $('#typeError').css('display','block');
    $('#productType').css('border','solid red');
}

// Check which SKU error
function skuError(error) {
    if(error == `SKU's not provided`)
        return "#skuError1";
    if(error == `SKU already exist`)
        return "#skuError2";
}

// Remove all errors from previous submit
function removeErrors () {
    $('#typeError').css('display','none');
    $('#skuError1').css('display','none');
    $('#skuError2').css('display','none');
    $('#nameError').css('display','none');
    $('#priceError').css('display','none');
    $('#sizeError').css('display','none');
    $('#weightError').css('display','none');
    $('#dimensionsError').css('display','none');
}

// Remove all red borders from previous submit
function removeBorders () {
    $('#productType').css('border','none');
    $('#sku').css('border','none');
    $('#name').css('border','none');
    $('#price').css('border','none');
    $('#size').css('border','none');
    $('#weight').css('border','none');
    $('#height').css('border','none');
    $('#width').css('border','none');
    $('#length').css('border','none');
}

/**
 * End Helper Functions
 * Begin Events
*/

// Event for selecting product type
select.addEventListener('change', (event) => {
    // console.log(event.target.value);
    if (event.target.value == 'Dvd') {
        dvd.style.display = "block";
        $('#size').attr("required", true);
    } else { 
        dvd.style.display = "none"; 
        $('#size').attr("required", false);
    }

    if (event.target.value == 'Book') {
        book.style.display = "block";
        $('#weight').attr("required", true);
    } else { 
        book.style.display = "none";
        $('#weight').attr("required", false);
    }

    if (event.target.value == 'Furniture') {
        furniture.style.display = "block";
        $('#height').attr("required", true);
        $('#width').attr("required", true);
        $('#length').attr("required", true);
    } else { 
        furniture.style.display = "none"; 
        $('#height').attr("required", false);
        $('#width').attr("required", false);
        $('#length').attr("required", false);
    }
});


// Event for submitting the add-product form
$(document).ready(function(){  
    $('#save_btn').click(function(event){
        // Preventing the default action to validate the data first
        event.preventDefault();

        // Check validity of the form
        if (!$('#product_form')[0].checkValidity()) {
            $('#product_form')[0].reportValidity();
            return;
        }
        if ($('#productType').val() == null) {
            validateType();
            return;
        }

        // Remove all errors from previous submit
        removeErrors();
        removeBorders();

        // Making AJAX request to 'validation.php' file
        $.ajax({
            type: 'POST',
            url: '../../Product/Validation/Validation.php',
            data: $('#product_form').serializeArray(),
            dataType: 'json',
            encode: true,
        
        }).success(function(response){
            if (response.success == "false") {
                // Validation failed -> report all validation errors
                if(response.sku) {
                    $(skuError(response.sku)).css('display','block');
                    $('#sku').css('border','solid red');
                }
                if(response.name) {
                    $('#nameError').css('display','block');
                    $('#name').css('border','solid red');
                }
                if(response.price) {
                    $('#priceError').css('display','block');
                    $('#price').css('border','solid red');
                }
                if(response.value) {
                    if (response.type == "Dvd") {
                        $('#sizeError').css('display','block');
                        $('#size').css('border','solid red');
                    }
                    else if (response.type == "Book") {
                        $('#weightError').css('display','block');
                        $('#weight').css('border','solid red');
                    }
                    else if (response.type == "Furniture") {
                        $('#dimensionsError').css('display','block');
                        $('#height').css('border','solid red');
                        $('#width').css('border','solid red');
                        $('#length').css('border','solid red');
                    }
                }
            } else {
                // Validation succeed
                window.location.href = '../../View/List/productList.php';
            }

        }).error(function(errorData){
            console.log("Error");
            console.log(errorData);

        });
    });
});

/**
 * End Events
 * 
*/