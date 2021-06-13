
<?php require_once("../resources/config.php"); ?>


<?php

// Adding To Cart ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

if(isset($_GET['add'])) {
    // Taking out from DB product detalis with sended GET id
    $query = query("SELECT * FROM products WHERE product_id=" . escape_string($_GET['add']) . " ");
    confirm($query);

    while($row = fetch_array($query)) {
        
        if($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            // adding to 'cart' and setting session variable with product id form 'add to cart' button
            $_SESSION['product_' . $_GET['add']] += 1;
            redirect("checkout.php");
        } else {
            // if there is no more product
            set_message("We only have '{$row['product_title']}' " . $row['product_quantity'] . " stuks avalible.");
            redirect("checkout.php");
        }
    }



    // Adding afer click on "Add to Cart", from GET we will get id of product added to cart
    // $_SESSION['product_' . $_GET['add']] += 1;
    // redirect("index.php");


    // sb-zreot3989321@business.example.com
}

// Removing From Cart ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

// remove 1 quantity button on checkout
if(isset($_GET['remove'])) {
    // decrementing value
    $_SESSION['product_' . $_GET['remove']]--;


    // if all removed
    if($_SESSION['product_' . $_GET['add']] < 1) {

        // refreshing page after all products deleted
        redirect("checkout.php");
    } else {

        redirect("checkout.php");
    }
}

// deleting whole quantity button on checkout
if(isset($_GET['delete'])) {
    // deleting whole value
    $_SESSION['product_' . $_GET['delete']] = '0';
    unset($_SESSION['total_items']);
    redirect("checkout.php");

}


// Function Displaying Cart ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function checkout_cart() {
    
    /*    SESSION vairable looks like this:
        cart_1, cart_2  <- cijfer is id of product  */


    // Total price, quantity for all procucts
    $total_items = 0;
    $total_price_for_all = 0;
    // Paypal variables
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quanity = 1;

    // Extracting SESSION Array one by one
    foreach ($_SESSION as $name => $value_id) {

        if($value_id > 0) {

            // cuting of string only to get number ID |product_1|
            if(substr($name, 0, 8) == 'product_') {

                $length = strlen($name) - 8;
                $id = substr($name, 8, $length);


                // If Substracting is good then show product in cart
                $query = query("SELECT * FROM products WHERE product_id= " . escape_string($id));
                confirm($query);
            
                // Showing products in Cart
                // Still to do !!!!!!!!!!!!!!!!!!!!!!!
                while($row = fetch_array($query)) {

                    // total price of 1 product
                    $sub_total_price = $row['product_price'] * $value_id;
                    // <td><a href="item.php?id={$row['product_id']}"><span class='glyphicon glyphicon-eye-open'></span></a>


                    $product = <<<DELIMETER
                    <tr>
                        <td>
                            <a href="item.php?id={$row['product_id']}">
                                <img class="checkout_image" src="{$row['product_image_min']}">
                            </a>
                        </td>
                        <td>{$row['product_title']}</td>
                        <td>€ {$row['product_price']}</td>
                        <td>{$value_id}</td>
                        <td>€ {$sub_total_price}</td>
                        <td>
                            <a class='btn btn-success' href="cart.php?add={$row['product_id']}">
                                <span class='glyphicon glyphicon-plus'></span>
                            </a>
            
                            <a class='btn btn-warning' href="cart.php?remove={$row['product_id']}">
                                <span class='glyphicon glyphicon-minus'></span>
                            </a>
            
                            <a class='btn btn-danger' href="cart.php?delete={$row['product_id']}">
                                <span class='glyphicon glyphicon-remove'></span>
                            </a>
                        </td>
                    </tr>

                    <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                    <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                    <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
                    <input type="hidden" name="quanity_{$quanity}" value="{$value_id}">

                DELIMETER;
                echo $product;


                // Paypal variables incrementing
                $item_name++;
                $item_number++;
                $amount++;
                $quanity++;

                }

                // items total amount
                $total_items += $value_id;
                // items total price
                $total_price_for_all += $sub_total_price;
            } else {

                // echo 'Substrat String NOT Successfully';
            }  
        }  
    }
    $_SESSION['total_price_for_all'] = $total_price_for_all;
    $_SESSION['total_items'] = $total_items;

}

























?>