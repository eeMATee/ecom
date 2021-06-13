<?php require_once("../resources/config.php"); ?>

<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p>
            <a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>  <!-- |X| jumbotron hero-spacer |X| -->
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <h3>Latest Product</h3>
            </div>  <!-- |X| col-lg-12 |X| -->
        </div>  <!-- |X| row |X| -->
        
        <div class="row text-center">
            <?php get_products_in_category_base_on_category(); ?>
        </div>
          <!-- |X| row text-center |X| -->
    </div>  
    <!-- |X| container |X| -->


<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>
