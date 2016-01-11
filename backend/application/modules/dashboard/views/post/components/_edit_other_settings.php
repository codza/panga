<?php
$attributes = array('class' => 'form-horizontal');
?>

    <?php echo validation_errors(); ?>


    <?php echo form_open(current_url(),$attributes);?>

            <input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
            <input type="hidden" name="postid" value="<?php echo $post->post_id;?>" />
            <div class="form-group" >
                <label class="col-md-2 control-label" for="inputPostKeywords">Post Keywords:</label>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="inputPostKeywords" name="postkeywords" value="<?php echo $post->post_keywords?>" placeholder="Post Keywords" />
                </div>
            </div>

            <div class="form-group" >
                <label class="col-md-2 control-label" for="inputDescription">Post Description :</label>
                <div class="col-md-6">
                    <textarea class="form-control" name="postdescription" id="inputDescription" placeholder="Type here ..." rows="3" ><?php echo $post->post_description?></textarea>
                </div>
            </div>

            <div class="form-group" >
                <div class="col-md-offset-2 col-md-4">
                    <button type="submit" name="updatedescription" class="btn">Update</button>
                </div>
            </div>


    <?php echo form_close();?>
    <div class="container col-md-12" id="result">

    </div>
