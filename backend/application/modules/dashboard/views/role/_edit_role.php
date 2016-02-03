<?php
$attributes = array('class' => 'form-horizontal');
?>
<div class="container-fluid">
    <?php echo validation_errors(); ?>
    <fieldset >
        <legend> Edit Role </legend>

        <?php echo form_open(current_url(), $attributes); ?>
        <input type="hidden" name="roleid" value="<?php echo $role->role_id; ?>" />
        <div class="form-group" >
            <label class="col-md-2 control-label"  for="inputRoleName">Role Name :</label>
            <div class="col-md-2" >
                <input type="text"  name="rolename" value="<?php echo $role->role_name; ?>" id="inputRoleName" placeholder="Role Name" class="form-control" />
            </div>
        </div>
        <div class="form-group" >
            <div class="col-md-offset-2 col-md-4">
                <button type="submit" class="btn">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </fieldset>
    <div>
        <?php echo anchor('dashboard/accessmanagement/view_roles', 'Back To List ', 'title="Role list"'); ?>
    </div>
</div>