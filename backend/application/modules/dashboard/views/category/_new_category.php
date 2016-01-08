<?php
$attributes = array('class' => 'form-horizontal','role'=>'form');
?>

<div class="container-fluid">
<?php echo validation_errors(); ?>
<fieldset >
<legend> Create Category </legend>

<?php echo form_open(current_url(),$attributes);?>
  <input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
  <div class="form-group" >
    <label class="col-md-2 control-label" for="inputCategoryName">Category Name :</label>
    <div class="col-md-4" >
      <input type="text" id="inputCategoryName" name="categoryname" value="<?php echo $datatoinsert["category_name"];?>" placeholder="Category Name" class="form-control" >
    </div>
  </div>

  <div class="form-group" >
    <label class="col-md-2 control-label" for="inputCategoryDescription">Category Description :</label>
    <div class="col-md-4">
        <textarea name="categorydescription" class="form-control" rows="3"  id="inputCategoryDescription" placeholder="Category Description" ><?php echo $datatoinsert["category_description"];?></textarea>
    </div>
  </div>

  <div class="form-group" >
    <div class="col-md-offset-2 col-md-4">
      <button type="submit" class="btn">Create</button>
    </div>
  </div>
<?php echo form_close();?>
</fieldset>
    <div>
        <?php  echo anchor('admin/categories', 'Back To List ', 'title="user list"');?>
    </div>
</div>
