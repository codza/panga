<?php  echo btn_add('dashboard/categories/create', 'Category');?>
<hr>
<table class="table">
	<thead>
		<tr>
			<th>Category Name</th>
			<th>Category Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($categories as $category):?>
		<tr>
			<td><?php echo $category->category_name;?></td>
			<td></td>

			<td> 
			<?php echo btn_edit('dashboard/categories/edit/'. $category->category_id ); ?> |
			<?php echo btn_delete('dashboard/categories/delete/'. $category->category_id); ?>
			</td>
		</tr>
<?php endforeach?>
	</tbody>
</table>