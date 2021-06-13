<?php


// ***************************** Helper Functions ***************************

// Message funciton
function set_message($msg) {
    if(!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

// Display message
function display_message() {
    if(isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

// Insted of Header || Redirecting
function redirect($location) {
    header("Location: $location");
}

// Insted of mysqli_query || Query
function query($sql) {
    global $connection;
    return mysqli_query($connection, $sql);
}

// Conforming query form DB
function confirm($result) {
    global $connection;
    if(!$result){
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

// Escape values
function escape_string($string) {
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}

// Fetch Array
function fetch_array($send_query) {
    global $connection;
    return mysqli_fetch_array($send_query);
}

// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~FRONDEND FUNCTIONS~~~~~~~~~~~~~~~~~~~~~~~~

// ***************************** Get Products ***************************

function get_products() {
    // if product is avaliable
    $query = query("SELECT * FROM products WHERE product_quantity BETWEEN 1 AND 10000");
    // Checking if query is good
    confirm($query);

    while($row = fetch_array($query)) {

    $product = <<<DELIMETER
                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt="item{$row['product_title']}"></a>
                            <div class="caption">
                                <h4 class="pull-right">&euro;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['short_desc']}</p>
                                <p>
                                    <a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add to Cart</a>
                                    <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                                </p>
                            </div>
                        </div>
                    </div>
                DELIMETER;

    echo $product;
    }
}

// Show single product thumbnail base on category in !Category.php
function get_products_in_category_base_on_category() {

    $query = query("SELECT * FROM products WHERE product_category_id=" . escape_string($_GET['id']) . " ");
    // Checking if query is good
    confirm($query);

    while($row = fetch_array($query)) {

        $product = <<<DELIMITER
 
 
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="{$row['product_image']}" alt = "">
                <div class="caption">
                    <h3>{$row['product_title']} </h3>
                    <h4 class="pull-right">&euro;{$row['product_price']}</h4>
                    <p>{$row['short_desc']}</p>
                    <p>
                        <a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add to Cart</a>
                        <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
         
         
         
         
        DELIMITER;

    echo $product;
    }
}

// ***************************** Get Categories ***************************

function get_categories() {
    $query = query("SELECT * FROM categories");

    // Checking query
    confirm($query);

    // Showing categories from DB
    while($row = fetch_array($query)) {
        $categories_links = <<<DELIMETER
                            <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>
                        DELIMETER;

    echo $categories_links;
    }
}



// Show single product thumbnail base on category in !Category.php
function get_products_in_shop_page() {

    $query = query("SELECT * FROM products");
    // Checking if query is good
    confirm($query);

    while($row = fetch_array($query)) {

        $product = <<<DELIMITER
 
 
        <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
                <img src="{$row['product_image']}" alt = "">
                <div class="caption">
                    <h4 class="pull-right">&euro;{$row['product_price']}</h4>
                    <h3>{$row['product_title']} </h3>
                    <p>{$row['short_desc']}</p>
                    <p>
                        <a class="btn btn-primary" href="cart.php?add={$row['product_id']}">Add to Cart</a>
                        <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                    </p>
                </div>
            </div>
        </div>
         
         
         
         
        DELIMITER;

    echo $product;
    }
}



// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~BACKEND FUNCTIONS~~~~~~~~~~~~~~~~~~~~~~~~

// Login function
function login_user() {

    if(isset($_POST['submit'])) {

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' 
                        AND password = '{$password}'");
    
        confirm($query);

        if(mysqli_num_rows($query) == 0) {
            set_message("Your Password or Username are wrong.");
            redirect("login.php");
            // unset($_SESSION['message']);
            } else {
                $_SESSION['username'] = $username;
            // set_message("Welcome to Admin Page '{$username}'.");
            redirect("admin");
            // unset($_SESSION['message']);
            }   
    }
}

// Send message form contact fomrulier 
function send_message() {
    if(isset($_POST['submit_contact'])) {


        $mail_to = "mateuszgrzywna@yahoo.nl";
        $name_contact_form = $_POST['name'];
        $email_contact_form = $_POST['email'];
        $subject_contact_form = $_POST['subject'];
        $message_contact_form = $_POST['message'];

        // Message type
        $headers = "From: {$name_contact_form} {$email_contact_form}";

        $result = mail($mail_to, $subject_contact_form, $message_contact_form, $headers);
            if(!$result) {
                set_message("ERROR, FAILED TO SEND MESSAGE"); 
                redirect('contact.php');
            } else {
                set_message("MESSAGE IS SENDED");
                redirect('contact.php');
            }        
    }
}













































?>