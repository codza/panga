
<?php
$this->load->view('web/components/media');
?>

<div class="container rhu-post-container">
		<div class="col-md-8 rhu_post_card">
			<article>
				<div class="container">
					<h1>Contact Address</h1><br>
					<div class="row text-center">
						<div class="col-sm-3 col-xs-6 first-box">
							<h1><span class="glyphicon glyphicon-earphone"></span></h1>
							<h3>Phone</h3>
							<p>+880-1700-987654</p><br>
						</div>
						<div class="col-sm-3 col-xs-6 second-box">
							<h1><span class="glyphicon glyphicon-home"></span></h1>
							<h3>Location</h3>
							<p>1036 Gulshan Road</p><br>
						</div>
						<div class="col-sm-3 col-xs-6 third-box">
							<h1><span class="glyphicon glyphicon-send"></span></h1>
							<h3>E-mail</h3>
							<p>info@yourdomain.com</p><br>
						</div>
						<div class="col-sm-3 col-xs-6 fourth-box">
							<h1><span class="glyphicon glyphicon-leaf"></span></h1>
							<h3>Web</h3>
							<p>www.yourdomain.com</p><br>
						</div>
					</div>
				</div>
			</article>
		</div>

		<!-- Sidebar -->
		<div class="col-md-3 pull-right">
			<div class="row">
				<div class="col-md-12 rhu_related_posts">
					<h2>Related <?php echo $related_category;?> <?php echo strcasecmp($related_category,"blogs") ==0 ?  "post" : ""; ?></h2>
					<?php echo post_by_cat_links($posts,$related_category); ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

</div>

