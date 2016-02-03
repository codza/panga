<?php
$attributes = array('class' => 'form-horizontal');
?>
<div class="container-fluid">
<?php echo validation_errors(); ?>
<fieldset >
<legend> Edit Permission </legend>

<?php echo form_open(current_url(),$attributes);?>
  <input type="hidden" name="permissionid" value="<?php echo $permission->perm_id;?>" />
    <div class="form-group" >
        <label class="col-md-2 control-label"  for="inputPermissionName">Permission Name :</label>
    <div class="col-md-2" >
      <input type="text"  name="permissionname" value="<?php echo $permission->perm_name;?>" id="inputPermissionName" placeholder="Permission Name" class="form-control" />
    </div>
  </div>

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPermissionDescription">Permission Description :</label>
    <div class="col-md-4" >
        <textarea  name="permissiondescription" id="inputPermissionDescription" placeholder="Permission Description" rows="3" class="form-control" ><?php echo $permission->perm_desc;?></textarea>
    </div>
  </div>

    <div class="form-group" >
        <div class="col-md-offset-2 col-md-4">
      <button type="submit" class="btn">Update</button>
    </div>
  </div>
<?php echo form_close();?>
</fieldset>
    <div>
        <?php  echo anchor('dashboard/accessmanagement/view_permissions', 'Back To List ', 'title="permission list"');?>
    </div>
</div>