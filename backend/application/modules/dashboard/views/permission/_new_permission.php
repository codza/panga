<?php
$attributes = array('class' => 'form-horizontal', 'role' => 'form');
?>

<div class="container-fluid">
    <?php echo validation_errors(); ?>
    <fieldset >
        <legend> Create Permission </legend>

        <?php echo form_open(current_url(), $attributes); ?>
        <div class="form-group" >
            <label class="col-md-2 control-label" for="inputPermissionName">Permission Name :</label>
            <div class="col-md-4" >
                <input type="text" id="inputPermissionName" name="permissionname" value="<?php echo $datatoinsert["perm_name"]; ?>" placeholder="Permission Name" class="form-control" >
            </div>
        </div>
        <div class="form-group" >
            <label class="col-md-2 control-label" for="inputPermissionDescription">Permission Description :</label>
            <div class="col-md-4">
                <textarea name="permissiondescription" class="form-control" rows="3"  id="inputPermissionDescription" placeholder="Permission Description" ><?php echo $datatoinsert["perm_desc"]; ?></textarea>
            </div>
        </div>

        <div class="form-group" >
            <div class="col-md-offset-2 col-md-4">
                <button type="submit" class="btn"> Add </button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </fieldset>
    <div>
        <?php echo anchor('admin/accessmanagement', 'Back To List ', 'title="Role list"'); ?>
    </div>
</div>
