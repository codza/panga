<fieldset >
<legend> Permission List </legend>

<table class="table">
	<thead>
		<tr>
			<th>Pemission Name</th>
			<th>Pemission Description</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
<?php foreach($permissions as $permission):?>
		<tr>
			<td><?php echo $permission->perm_name;?></td>
			<td><?php echo $permission->perm_desc;?></td>

			<td> 
			<?php echo btn_edit('dashboard/rabc/edit_permission/'. $permission->perm_id ); ?> |
			<?php echo btn_delete('dashboard/rabc/delete_permission/'. $permission->perm_id ); ?>
			</td>
		</tr>
<?php endforeach?>
	</tbody>
</table>
</fieldset>