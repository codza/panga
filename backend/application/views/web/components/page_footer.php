</div>
<div class="clearfix"></div>
<div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h4><?php echo $meta_title; ?></h4>
                <p>
                    <?php echo  get_primary_link($primary_posts); ?>
                </p>
            </div><!-- /col-lg-4 -->

            <div class="col-lg-4 text-center rhu_social">
                <h4>Get Social with us</h4>
                <p >
                    <a href="https://ug.linkedin.com/in/reviving-hope-39853771" target="_blank"><i class="fa fa-linkedin fa-2x"></i>&nbsp;</a>
                    <a href="https://www.facebook.com/RevivngHopeUganda/" target="_blank"><i class="fa fa-facebook fa-2x"></i>&nbsp;</a>
                    <a href="https://www.twitter.com/ReviveUg" target="_blank"><i class="fa fa-twitter fa-2x"></i>&nbsp;</a>
                </p>
            </div><!-- /col-lg-4 -->

            <div class="col-lg-4">
                <h4>Our Contact</h4>
                <p>
                    <span class="glyphicon glyphicon-phone" ></span> +256-700 427 010<br>
                    <span class="glyphicon glyphicon-phone" ></span> +256-706 756 500<br>
                    <span class="glyphicon glyphicon-envelope"></span> revivinghopeug@gmail.com

                </p>
            </div><!-- /col-lg-4 -->

        </div>

    </div>
    <div class="container text-center rhu_date_footer">
        <p>Copyright &copy; <?php echo date("Y"); ?> , <?php echo $meta_title; ?></p>
    </div>
</div>
    <!-- JavaScript -->
   <!-- <script src="http://code.jquery.com/jquery-latest.js"></script>-->
    <script src="<?php echo site_url('assets/jquery/jquery-1.12.0.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>


</body>
</html>
