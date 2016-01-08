<?php
$attributes = array('class' => 'form-horizontal');
?><?php echo validation_errors(); ?>
<div class="container-fluid">
<fieldset >
<legend> Edit password</legend>
    <?php echo form_open(current_url(),$attributes);?>
<input type='hidden' name='userid' value="<?php echo $this->userSession->user_id; ?>" />

    <div class="form-group" >
        <label class="col-md-4 control-label" for="inputCurrentPassword">Current Password</label>
    <div class="col-md-4">
      <input type="password" class="form-control" id="inputCurrentPassword" name="current_password" placeholder="Your current password" value="" />
    </div>
  </div>

  <div class="form-group" >
          <label class="col-md-4 control-label" for="inputNew_password_1">New Password</label>
    <div class="col-md-4">
      <input type="password" class="form-control" id="inputNew_password_1" name="new_password_1" placeholder="Your new password" value="" />
    </div>
  </div>



  <div class="form-group" >
        <label class="col-md-4 control-label" for="inputNew_password_2">retype new Password</label>
    <div class="col-md-4">
      <input type="password" class="form-control" id="inputNew_password_2" name="new_password_2" placeholder="Retype new password" value="" />
    </div>
  </div>


    <div class="form-group" >
        <div class="col-md-offset-4 col-md-4">
      <button type="submit" class="btn">Update</button>
    </div>
  </div>
<?php echo form_close();?>
</fieldset>
    <div>
        <?php  echo anchor('admin/settings', 'Back To settings ', 'title="User Settings"');?>
    </div>
</div>

