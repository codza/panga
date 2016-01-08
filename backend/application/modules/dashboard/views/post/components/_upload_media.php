<?php
$attributes = array('class' => 'form-horizontal');
?>
    <?php echo form_open_multipart('dashboard/posts/upload_media',  $attributes);?>
    <input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
    <input type="hidden" name="postid" value="<?php echo $post->post_id;?>" />

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputContent">Post Media :</label>
        <div class="col-md-8">
            <input type="file" class="form-control" id="inputfile" name="userfile"  />
        </div>
    </div>
    <div class="form-group" >
        <div class="col-md-offset-2 col-md-4">
            <button type="submit" class="btn">Update</button>
        </div>
    </div>
    <?php echo form_close();?>
