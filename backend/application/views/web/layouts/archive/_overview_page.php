<div class="container">
    <div class="row">
		<!-- Main content -->

 		<div class="col-md-8">
<?php //if($pagination): ?>
			<section class="pagination">
                <?php// echo $pagination; ?>
            </section>
<?php// endif; ?>

<?php
//if (count($articles)): foreach ($articles as $article):
echo $post->post_content;
?>
 				<article class="col-md-4"><?php //echo get_excerpt($article); ?><hr></article>
<?php// endforeach; endif; ?>
 			</div>
 		</div>
 		
 		<!-- Sidebar -->
 		<div class="col-md-4 sidebar">
 			<h2>Recent news</h2>
            <?php //$this->load->view('site/sidebar'); ?>
 		</div>


</div>