<?php
$attributes = array('class' => 'form-horizontal');
?>
<?php echo validation_errors(); ?>
 Edit Category
 <hr>
<?php echo form_open(current_url(),$attributes);?>
  <input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
  <input type="hidden" name="categoryid" value="<?php echo $category->category_id;?>" />
    <div class="form-group" >
        <label class="col-md-2 control-label"  for="inputCategoryName">Category Name :</label>
    <div class="col-md-2" >
      <input type="text"  name="categoryname" value="<?php echo $category->category_name;?>" id="inputCategoryName" placeholder="Category Name" class="form-control" />
    </div>
  </div>

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputCategoryDescription">Category Description :</label>
    <div class="col-md-4" >
        <textarea  name="categorydescription" id="inputCategoryDescription" placeholder="Category Description" rows="3" class="form-control" ><?php echo $category->category_description;?></textarea>
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
        <?php  echo anchor('dashboard/categories', 'Back To List ', 'title="user list"');?>
    </div>