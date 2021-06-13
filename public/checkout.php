

<!-- Config & Header include -->
<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<?php


    
    // PRODUCT AFTER INCREMENTATION
    // if(isset($_SESSION['product_1'])) {
    //     echo $_SESSION['product_1'];
    // }
    

    // Send Price to add to total price
    $sending_price = 5;
    $free_sending_amount = 150;

?>



<!-- Page Content -->
<div class="container">
    <div class="row">
                                            
        <h4 class="text-center bg-danger">
            <!-- Displaying message -->
            <?php display_message(); ?> 
        </h4>
        
        <h1>Checkout</h1>  
            <!-- Paypal -->
            <form action="https://www.sandbox.paypal.com/cgi-bin/webscr"    method="post">
                <input type="hidden" name="cmd" value="_cart">
                <input type="hidden" name="business" value="sb-pzefm3980386@business.example.com">
                <input type="hidden" name="currency_code" value="EUR">
                <input type="hidden" name="upload" value="1">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th></th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Sub-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Function displaing form cart -->
                        <?php checkout_cart(); ?>

                    </tbody>
                </table>
                <!-- If cart is empty button dont show up-->
                <?php 
                    if($_SESSION['total_items'] > 0) {
                    echo  '<input type="image" name="upload"
                            src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                            alt="PayPal - The safer, easier way to pay online">';
                    }
                ?> 
            </form>
    </div>   
    <!-- |X| row |X| -->



<!--  ***********CART TOTALS*************-->
                    
        <div class="col-xs-4 pull-right">
            <h2>Cart Totals</h2>

            <table class="table table-bordered" cellspacing="0">

                <tr class="cart-subtotal">
                    <th>Total Items:</th>
                    <td><span class="amount">

                        <!-- Total Price for All-->
                        <?php
                             echo isset($_SESSION['total_items']) ? $_SESSION['total_items'] : $_SESSION['total_items'] = "0";
                        ?>

                    </span></td>
                </tr>
                <tr class="shipping">
                    <th>Shipping and Handling</th>
                    <td>
                        <!-- Free shiping or no -->
                        <?= ($_SESSION['total_price_for_all'] > $free_sending_amount) ? "Free" : "{$sending_price} €"; ?>

                    </td>
                </tr>

                <tr class="order-total">
                    <th>Order Total</th>
                    <td><strong>
                        <!-- Total Price for All-->
                        <span class="amount"> € 


                            <?php
                                if(isset($_SESSION['total_price_for_all'])) {
                                    if($_SESSION['total_price_for_all'] > $free_sending_amount) {
                                        // free sending, price bigger thane free sending 
                                        echo $_SESSION['total_price_for_all'];
                                    } else {
                                        // if have to pay fo shipping
                                        $price_with_shipping = $_SESSION['total_price_for_all'] + $sending_price;
                                        echo $price_with_shipping;
                                    }
                                } else {
                                    // if cart is empty
                                    echo $_SESSION['total_price_for_all'] = "";
                                }



                            ?>
                        </span></strong> </td>
                </tr>
                </tbody>

            </table>
        </div>
        <!-- |X| col-xs-4 pull-right |X| -->
 </div>
<!-- |X| container |X| -->


    <hr>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>