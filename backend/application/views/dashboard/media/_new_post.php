<?php
$attributes = array('class' => 'form-horizontal');


?>


    <?php echo validation_errors(); ?>
<fieldset >
<legend> Create Post </legend>

<?php echo form_open(current_url(),$attributes);?>
  <input type="hidden" name="userid" value="<?php echo $this->session->userdata['user_data']['user_id'];?>" />
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostName">Post Name :</label>
    <div class="col-md-4">
      <input type="text" class="form-control" id="inputPostName" name="postname" value="<?php echo $datatoinsert["post_name"];?>" placeholder="Post Name"/>
    </div>
  </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostTitle">Post Title :</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputPostTitle" name="posttitle" value="<?php echo $datatoinsert["post_title"];?>" placeholder="Post Title" />
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostSlug">Post Slug :</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputPostSlug" name="postslug" value="<?php echo $datatoinsert["post_slug"];?>" placeholder="Post Slug" />
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostType">Post Type :</label>
        <div class="col-md-4">
            <?php $attr = 'id="inputPostType" class="form-control"';
            ($datatoinsert["post_type"] == null) ? $posttype = "primary_page": $posttype = $datatoinsert["post_type"];

            ?>
            <?php echo form_dropdown('posttype', array('primary_page' => 'Primary Page', 'secondary_page' => 'Secondary Page'),$posttype,$attr ); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostTemplate">Post Template :</label>
        <div class="col-md-4">
            <?php $attr = 'id="inputPostTemplate" class="form-control"';
            ($datatoinsert["post_template"] == null) ? $posttemplate = "page": $posttemplate = $datatoinsert["post_template"];

            ?>
            <?php echo form_dropdown('posttemplate',
                array('welcome_page' => 'Welcome Page',
                'primary_page' => 'Primary Page',
                    'secondary_page' => 'Secondary Page',
                    'posts_by_category' => 'Posts by category',
                    'stuff_members_page' => 'Stuff members Page',
                    'posts_by_category_page' => 'Posts By Category'),$posttemplate,$attr ); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputParentId">Post Parent :</label>
        <div class="col-md-4">
            <?php
            ($datatoinsert["parent_id"] == null) ? $parentid = "0": $parentid = $datatoinsert["parent_id"];

            $attr = 'id="inputParentId" class="form-control"';
            echo form_dropdown('parentid', $post_no_parents, $parentid , $attr);
            ?>

        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputCategoryId">Category :</label>
        <div class="col-md-4">
            <?php
            ($datatoinsert["category_id"] == null) ? $categoryid = "0": $categoryid = $datatoinsert["category_id"];


            $attr = 'id="inputCategoryId" class="form-control"';
            echo form_dropdown('categoryid', $categories, $categoryid , $attr);
            ?>

        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="inputPublicationDate">Publication date </label>
        <div class="col-md-4">
            <?php echo form_input('publicationdate', set_value('publicationdate', $datatoinsert["publication_date"] ),'class="form-control datepicker" id="inputPublicationDate" placeholder="Publication Date"'); ?>

        </div>
    </div>

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputContent">Post Content :</label>
    <div class="col-md-8">
        <textarea class="form-control" name="postcontent" id="inputContent" placeholder="type here ..." >
            <?php echo $datatoinsert["post_content"];?>
        </textarea>
    </div>
  </div>

    <div class="form-group" >
        <div class="col-md-offset-2 col-md-4">
      <button type="submit" class="btn">Create Post</button>
    </div>
  </div>
<?php echo form_close();?>
</fieldset>
    <hr>
<div>
     <?php  echo anchor('admin/posts', 'Back To List ', 'title="user list"');?>
</div>