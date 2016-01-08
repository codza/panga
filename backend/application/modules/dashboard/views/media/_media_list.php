<div class="container">

	<div class="row">

		<div class="col-lg-12">
			<h1 class="page-header">Media Gallery</h1>
		</div>
		<?php if(count($images)>0): foreach($images as $image):?>


			<div class="col-lg-3 col-md-4 col-xs-6 thumb text-center" >
				<div class="text-left">
					<h5>Post name: <?php echo $image->post_name;?></h5>
				</div>
				<div class="thumbnail rhu_thumbnail">
					<a href="<?php echo base_url("media/images/".get_media_url($image));?>" data-gallery="" >
						<div style="background-image:url(<?php echo base_url("media/images/thumb/".get_media_url($image, true));?>);"
							 class="fill rhu_image_thumbnail" alt="<?php echo $image->media_name;?>"></div>
					</a>

				</div>



				<div>
					<?php echo btn_edit('dashboard/medias/edit/'. $image->media_id ); ?> |
					<?php echo btn_delete('dashboard/medias/delete/'. $image->media_id); ?>
				</div>
			</div>





		<?php endforeach;?>
		<?php else: ?>
			<div>
				<h1> No Images could be found </h1>
			</div>

		<?php endif;?>

	</div>

</div>
<div id="blueimp-gallery" class="blueimp-gallery">
	<!-- The container for the modal slides -->
	<div class="slides"></div>
	<!-- Controls for the borderless lightbox -->
	<h3 class="title"></h3>
	<a class="prev"> <small></small><i class="glyphicon glyphicon-chevron-left "></i></small> </a>
	<a class="next"> <i class="glyphicon glyphicon-chevron-right small"></i> </a>
	<a class="close"> x </a>
	<a class="play-pause"></a>
	<ol class="indicator"></ol>
	<!-- The modal dialog, which will be used to wrap the lightbox content -->
	<div class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" aria-hidden="true">&times;</button>
					<h4 class="modal-title"></h4>
				</div>
				<div class="modal-body next"></div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left prev">
						<i class="glyphicon glyphicon-chevron-left"></i>
						Previous
					</button>
					<button type="button" class="btn btn-primary next">
						Next
						<i class="glyphicon glyphicon-chevron-right"></i>
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
