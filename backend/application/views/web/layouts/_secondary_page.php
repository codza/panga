
<?php
$this->load->view('web/components/media');
?>

<div class="container rhu-post-container">
		<div class="col-md-9 rhu_post_view">

				<h1><?php echo e($post->post_title); ?></h1>
				<div class="text-justify" >

					<?php echo html_entity_decode($post->post_content); ?>

				</div>
				<div>
					Author: <?php echo e($post->first_name)." ".strtoupper(e($post->last_name));?> <br>
					Published date:<?php echo date("D, d/ m / Y", strtotime($post->created_date)); ?>
				</div>

		</div>

		<!-- Sidebar -->
		<div class="col-md-3 pull-right">
			<div class="row">
				<div class="col-md-12 rhu_related_posts">
					<h2>Related <?php echo $related_category;?> <?php echo strcasecmp($related_category,"blogs") ==0 ?  "post" : ""; ?></h2>
					<?php
					//var_dump($posts);
					echo post_by_cat_links($posts,$related_category,$website_url_array); ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

</div>

