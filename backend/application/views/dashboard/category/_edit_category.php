<?php
$attributes = array('class' => 'form-horizontal');
?>
<div class="container-fluid">
    <?php echo validation_errors(); ?>
    <fieldset >
        <legend> Creae User </legend>

        <?php echo form_open(current_url(), $attributes); ?>
        <input type="hidden" name="categoryid" value="<?php echo $category->category_id; ?>" />
        <div class="form-group" >
            <label class="col-md-2 control-label"  for="inputCategoryName">Category Name :</label>
            <div class="col-md-2" >
                <input type="text"  name="categoryname" value="<?php echo $category->category_name; ?>" id="inputCategoryName" placeholder="Category Name" class="form-control" />
            </div>
        </div>
        <div class="form-group" >
            <div class="col-md-offset-2 col-md-4">
                <button type="submit" class="btn">Update</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </fieldset>
    <div>
        <?php echo anchor('dashboard/categories', 'Back To List ', 'title="Categories list"'); ?>
    </div>
</div>