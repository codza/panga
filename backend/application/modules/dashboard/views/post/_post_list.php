<div class="col-lg-12">

	<?php  echo btn_add('dashboard/posts/create', 'Post');?>
	<hr>
	<table class="table">
		<thead>
			<tr>
				<th>Post Title</th>
				<th>Post Content</th>
				<th> </th>
			</tr>
		</thead>
		<tbody>
	<?php if(count($posts)): foreach($posts as $post):?>
			<tr>

				<td><?php echo $post->post_title; ?></td>
				<td><?php echo text_trunk($post->post_content,5);?></td>
				<td>
				<?php echo btn_edit('dashboard/posts/edit/'. $post->post_id ); ?> |
				<?php echo btn_delete('dashboard/posts/delete/'. $post->post_id); ?>
				</td>
			</tr>
	<?php endforeach;?>
	<?php else: ?>
		<tr>
			<td colspan="4"> No post could be found </td>
		</tr>

	<?php endif;?>
		</tbody>
		<tfoot>
		<tr>
			<td colspan="4">
				<?php
					//echo $create_links;
				?>
			</td>
		</tr>
		</tfoot>
	</table>

</div>
