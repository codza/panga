<?php
$attributes = array('class' => 'form-horizontal','role'=>'form');
?>

<?php echo validation_errors(); ?>
 Create Category
<hr>
<?php echo form_open(current_url(),$attributes);?>
  <div class="form-group" >
    <label class="col-md-2 control-label" for="inputCategoryName">Category Name :</label>
    <div class="col-md-4" >
      <input type="text" id="inputCategoryName" name="categoryname" value="<?php echo $datatoinsert["category_name"];?>" placeholder="Category Name" class="form-control" >
    </div>
  </div>

  <div class="form-group" >
    <div class="col-md-offset-2 col-md-4">
      <button type="submit" class="btn">Create</button>
    </div>
  </div>
<?php echo form_close();?>

    <div>
        <?php  echo anchor('dashboard/categories', 'Back To List ', 'title="Categories list"');?>
    </div>

