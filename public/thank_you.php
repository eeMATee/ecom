
<!-- Config & Header include -->
<?php require_once("../resources/config.php"); ?>
<?php require_once("cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>


<?php

    // Info after paypal buy
    if(isset($_GET['tx'])) {

        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];

        // taking out order_transaction and checking if is already in DB
        $query_transaction = query("SELECT order_transaction FROM orders WHERE order_transaction = {$transaction}");
        confirm($query_transaction);
        
        session_destroy();
        // if order is already place, to prevent putting order on more time after refreshing thank_you.php page
        if($row = fetch_array($query_transaction) > 0) {
            // if already is in database order
            echo "";

        } else {
            $query = query("INSERT INTO orders (order_id, order_amount, order_transaction, order_status, order_currency) VALUES (NULL, '{$amount}', '{$transaction}', '{$status}', '{$currency}')");
            confirm($query);

        }


    } else {
        redirect('index.php');
    }


?>



<!-- Page Content -->
<div class="container">
   

        <h1 class="text-center">Thank You For Your Purchase ! :)</h1>
        <h3 class="text-center"> 
            Your transaction number is: <?= $transaction ?> 
        </h3>

        <a class='btn btn-success center flex-center' href="index.php"> Go Back To Shop</a>
                                

 </div>
<!-- |X| container |X| -->


    <hr>

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>