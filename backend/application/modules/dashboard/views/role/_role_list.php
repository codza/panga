<fieldset >
    <legend> Role Management </legend>
    <table class="table">
        <thead>
            <tr>
                <th>Role Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?php echo $role->role_name; ?></td>
                    <td> 
                        <?php echo btn_edit('dashboard/accessmanagement/edit_role/' . $role->role_id); ?> |
                        <?php echo btn_delete('dashboard/accessmanagement/delete_role/' . $role->role_id); ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</fieldset>