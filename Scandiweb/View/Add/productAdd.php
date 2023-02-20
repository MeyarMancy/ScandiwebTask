<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <link rel="stylesheet" href="../../Public/css/styles.css">
        <title>
            Product Add
        </title>
    </head>
    <body>
        <!-- Header of the page -->
        <header>
            <nav class="navbar">
                <div class="title">
                    <h2>Product Add</h2>
                </div>
                <div class="form">
                    <form id="add_form" action="" method="post">
                        <!-- Save button connect first to a jQuery file to validate data, if validated save the new record to database -->
                        <button type="submit" value="save" name="save" id="save_btn" class="buttons" form="product_form">Save</button>
                        <!-- Cancel button to redirect to the 'product list' page -->
                        <button type="submit" value="cancel" name="cancel" id="cancel_btn" class="buttons" formaction="../List/productList.php">Cancel</button>
                    </form>
                </div>
            </nav>
        </header>
        <hr>
        <!-- Main body of the page -->
        <main>
            <form id="product_form" action="../../Product/Validation/Validation.php" method="post">
                <!-- Main field including SKU, name, price & product type -->
                <fieldset class="mainField">
                    <!-- SKU field -->
                    <div class="fieldset">
                        <label class="label">SKU :</label>
                        <input type="text" name="sku" id="sku" class="input" placeholder="Type here..." required>
                        <small id="skuError1" class="errors">SKU's not provided</small>
                        <small id="skuError2" class="errors">SKU already exist</small>
                    </div>
                    <!-- Name field -->
                    <div class="fieldset">
                        <label class="label">Name :</label>
                        <input type="text" name="name" id="name" class="input" placeholder="Type here..." required>
                        <small id="nameError" class="errors">Name's invalid</small>
                    </div>
                    <!-- Price field -->
                    <div class="fieldset">
                        <label class="label">Price ($):</label>
                        <input type="number" name="price" id="price" class="input" placeholder="Type here..." required step="0.01" min="0" >
                        <small id="priceError" class="errors">Price's invalid</small>
                    </div>
                    <br>
                    <!-- Type switcher field -->
                    <div class="fieldset">
                        <label class="label">Type Switcher :</label>
                        <select name="selector" class="input" id="productType" required>
                            <option disabled="" value="select" selected=""> Select type...</option>
                            <option name="dvd" value="Dvd" id="Dvd">DVD</option>
                            <option name="book" value="Book" id="Book">Book</option>
                            <option name="furniture" value="Furniture" id="Furniture">Furniture</option>
                        </select>
                        <small id="typeError" class="errors">Please, select a type</small>
                    </div>
                </fieldset>
                <!-- Three fields for each product type (DVD/Book/Furniture) will be displayed based on what the user selected -->
                <!-- DVD field -->
                <fieldset id="DVDField">
                    <div class="fieldset">
                        <label class="label">Size (MB):</label>
                        <input type="number" name="size" id="size" class="input" placeholder="Type here..." step="0.1">
                        <small id="sizeError" class="errors">Size's invalid</small>
                    </div>
                    <p class="label description">Please, provide size</p>
                </fieldset>
                <!-- Book field -->
                <fieldset id="BookField">
                    <div class="fieldset">
                        <label class="label">Weight (KG):</label>
                        <input type="number" name="weight" id="weight" class="input" placeholder="Type here..." step="0.1">
                        <small id="weightError" class="errors">weight's invalid</small>
                    </div>
                    <p class="label description">Please, provide weight</p>
                </fieldset>
                <!-- Furniture field -->
                <fieldset id="FurnitureField">
                    <div class="fieldset">
                        <label class="label">Height (CM):</label>
                        <input type="number" name="height" id="height" class="input" placeholder="Type here..." step="0.1">
                    </div>
                    <div class="fieldset">
                        <label class="label">Width (CM):</label>
                        <input type="number" name="width" id="width" class="input" placeholder="Type here..." step="0.1">
                    </div>
                    <div class="fieldset">
                        <label class="label">Length (CM):</label>
                        <input type="number" name="length" id="length" class="input" placeholder="Type here..." step="0.1">
                    </div>
                        <small id="dimensionsError" class="errors">Dimensions's invalid</small>
                    <p class="label description">Please, provide dimensions</p>
                </fieldset>
            </form>
        </main>
        <script src="../../Public/js/script.js"></script>
        <!-- Footer of the page -->
        <?php include("../Footer/footer.php"); ?>
</body>
</html>