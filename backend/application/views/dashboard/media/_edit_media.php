<?php
$attributes = array('class' => 'form-horizontal');
?>
<?php echo validation_errors(); ?>
Edit Media
<hr>
<?php echo form_open(current_url(),$attributes);?>
<input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
<input type="hidden" name="mediaid" value="<?php echo $media->media_id;?>" />
    <div class="form-group" >
        <label class="col-md-3 control-label"  for="inputMediaName">
            <img src="<?php echo base_url("media/images/thumb/".get_media_url($media, true) );?>" />

        </label>
    </div>
<div class="form-group" >
    <label class="col-md-2 control-label"  for="inputMediaName">Media Name :</label>
    <div class="col-md-2" >
        <input type="text"  name="medianame" value="<?php echo $media->media_name;?>" id="inputMediaName" placeholder="Media Name" class="form-control" />
    </div>
</div>

<div class="form-group" >
    <div class="col-md-offset-2 col-md-4">
        <button type="submit" class="btn">Update</button>
    </div>
</div>
<?php echo form_close();?>
<hr>

<div>
    <?php  echo anchor('dashboard/medias', 'Back To List ', 'title="user list"');?>
</div>