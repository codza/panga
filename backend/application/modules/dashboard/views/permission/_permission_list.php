<fieldset >
<legend> Permission List </legend>

<table class="table">
	<thead>
		<tr>
			<th>Category Name</th>
			<th>Category Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($permissions as $permission):?>
		<tr>
			<td><?php echo $permission->perm_name;?></td>
			<td><?php echo $permission->perm_desc;?></td>

			<td> 
			<?php echo btn_edit('dashboard/accessmanagement/edit_permission/'. $permission->perm_id ); ?> |
			<?php echo btn_delete('dashboard/accessmanagement/delete_permission/'. $permission->perm_id ); ?>
			</td>
		</tr>
<?php endforeach?>
	</tbody>
</table>
</fieldset>