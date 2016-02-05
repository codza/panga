<?php
$attributes = array('class' => 'form-horizontal','role'=>'form');
?>

<div class="container-fluid">
<?php echo validation_errors(); ?>
<fieldset >
<legend> Ajouter Un role Utilisateur </legend>

<?php echo form_open(current_url(),$attributes);?>
  <div class="form-group" >
    <label class="col-md-2 control-label" for="inputRoleName">Role Name :</label>
    <div class="col-md-4" >
      <input type="text" id="inputRoleName" name="rolename" value="<?php echo $datatoinsert["role_name"];?>" placeholder="Role Name" class="form-control" >
    </div>
  </div>
  <div class="form-group" >
    <div class="col-md-offset-2 col-md-4">
      <button type="submit" class="btn">Add Role</button>
    </div>
  </div>
<?php echo form_close();?>
</fieldset>
    <div>
       
        <?php  echo anchor('dashboard/rabc', 'Back To List ', 'title="role list"');?>
    </div>
</div>
