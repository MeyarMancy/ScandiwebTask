<?php 

use App\Database\Database;

//Requiring the autoloader
require '../../vendor/autoload.php';

$database = new Database();

if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['delete'])) {
    if (isset($_POST['checked'])) {
        // Delete all the 'checked' products
        foreach ($_POST['checked'] as $check){
            $result = $database->delete($check);
        }
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../Public/css/styles.css">
        <title>
            Product List
        </title>
    </head>
    <body>
        <!-- Header of the page -->
        <header>
            <nav class="navbar">
                <div class="title">
                    <h2>Product List</h2>
                </div>
                <div class="form">
                    <form id="list-header" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
                        <!-- Add button to redirect to the 'product add' page -->
                        <button type="submit" value="add" name="add" id="add_btn" class="buttons" formaction="../Add/productAdd.php">ADD</button>
                        <!-- Delete button to delete all the selected products -->
                        <button type="submit" value="delete" name="delete" id="delete_btn" class="buttons" form="list-header">MASS DELETE</button>
                    </form>
                </div>
            </nav>
        </header>
        <hr>
        <!-- Main body of the  page -->
        <main>
            <div class="container">
                <section class="cards">

                    <?php
                    // Read all data from the database
                    $result = $database->read();
                    if ($result->num_rows > 0) {
                        // for each record print out a card to display the product's data
                        while($row = $result->fetch_assoc()) {
                            echo '<article class="card">
                                    <div class="check"><input type="checkbox" class="delete-checkbox" name="checked[]" value='.$row["sku"].' form="list-header"></div>
                                    <div class="info">
                                        <p>'.$row["sku"].'</p>
                                        <p>'.$row["name"].'</p>
                                        <p>'.$row["price"].'$</p>
                                        <p>'.$row["value"].'</p>
                                    </div>
                                </article>';
                        } 
                    }
                    ?>

                </section>
            </div>
        </main>
        <!-- Footer of the page -->
        <?php include("../Footer/footer.php");?>
    </body>
</html>

