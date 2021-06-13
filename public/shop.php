<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header >
            <h1>Shop</h1>
        </header>
        <!-- |X| jumbotron hero-spacer |X| -->
        <hr>        
        <div class="row text-center">
            <?php get_products_in_shop_page(); ?>
        </div>
          <!-- |X| row text-center |X| -->
    </div>  
    <!-- |X| container |X| -->


<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>