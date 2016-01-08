
<div class="container-fluid">
	<section>
		<h2>Order pages</h2>
		<p class="alert alert-info">Drag to order pages and then click 'Save'</p>
		<div id="orderResult"></div>
		<input type="button" id="save" value="Save" class="btn btn-primary" />
	</section>
</div>

<script>
$(function() {
	$.post('<?php echo site_url('dashboard/posts/order_ajax'); ?>', {}, function(data){
		$('#orderResult').html(data);
	});

	$('#save').click(function(){
		oSortable = $('.sortable').nestedSortable('toArray');

       // console.log(oSortable);

		$('#orderResult').slideUp(function(){
			$.post('<?php echo site_url('dashboard/posts/order_ajax'); ?>', { sortable: oSortable }, function(data){
				$('#orderResult').html(data);
				$('#orderResult').slideDown();
			});
		});

	});
});
</script>