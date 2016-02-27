<nav class="navbar navbar-inverse navbar-fixed-top rhu_navbar" role="navigation" >
    <div class="container-fluid" id="rhu_navbar" >
        <div class="navbar-header rhu_navbar_header align-center">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-nlbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a  class=" rhu_navbar_brand navbar-brand " href="<?php echo base_url();?>">
                <img class="rhu-logo hidden-xs" src="<?php echo base_url("assets/images/rhu-logo.png"); ?>" alt="R.H.U"><?php echo $meta_title; ?>
            </a>

        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->

        <div class="collapse navbar-collapse navbar-nlbar-collapse pull-right bottom-align-text"  >
            <?php
            ///echo get_menu($menu);
            echo get_primary_menu($primary_posts); ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
<div class="main-content">

