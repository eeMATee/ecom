
<?php require_once("../resources/config.php"); ?>

<!-- Including Header -->
<?php include(TEMPLATE_FRONT . DS . "header.php") ?>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <!-- Categories here (side_nav.php) -->
            <?php include(TEMPLATE_FRONT . DS . "side_nav.php") ?>
            <!--/. Categories here (side_nav.php) -->

            <div class="col-md-9">
                <div class="row carousel-holder">
                    <div class="col-md-12">   
                    
                        <!-- Carouse (slider.php) -->
                        <?php include(TEMPLATE_FRONT . DS . "slider.php") ?>
                        <!--/. Carouse (slider.php) -->

                    </div>    <!-- |X| col-md-12 |X| -->
                </div>  <!-- |X| row carousel-holder |X| -->

                <div class="row">
                    <?php get_products(); ?>
                </div>  <!-- |X| row |X| -->

            </div>  <!-- |X| col-md-9 |X| -->
        </div>   <!-- |X| row |X| -->
    </div>   <!-- |X| container |X| -->
    

<?php include(TEMPLATE_FRONT . DS . "footer.php") ?>