<?php
$attributes = array('class' => 'form-horizontal');
?>

<?php echo validation_errors(); ?>


<?php echo form_open(current_url(),$attributes);?>
    <input type="hidden" name="userid" value="<?php echo $this->userSession->user_id;?>" />
    <input type="hidden" name="postid" value="<?php echo $post->post_id;?>" />

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostIsActive">Active:</label>
        <div class="col-md-2">
            <input type="checkbox" id="inputPostIsActive" name="postisactive" >
        </div>
    </div>

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostName">Post Name :</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputPostName" name="postname" value="<?php echo $post->post_name;?>" placeholder="Post Name" />
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostTitle">Post Title :</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputPostTitle" name="posttitle" value="<?php echo $post->post_title;?>" placeholder="Post Title" />
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostSlug">Post Slug :</label>
        <div class="col-md-4">
            <input type="text" class="form-control" id="inputPostSlug" name="postslug" value="<?php echo $post->post_slug;?>" placeholder="Post Slug" />
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputPostType">Post Type :</label>
        <div class="col-md-4">
            <?php $attr = 'id="inputPostType" class="form-control"';
            ( $post->post_type == null) ? $posttype = "primary_page": $posttype = $post->post_type;

            ?>
            <?php echo form_dropdown('posttype', array('primary_page' => 'Primary Page', 'secondary_page' => 'Secondary Page'),$posttype,$attr ); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputParentId">Post Parent </label>
        <div class="col-md-4">
            <?php
            ($post->parent_id == null ) ? $parentid = "0": $parentid = $post->parent_id;

            $attr = 'id="inputParentId" class="form-control"';
            echo form_dropdown('parentid', $post_no_parents, $parentid , $attr);
            ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label"  for="inputPostTemplate">Post Template </label>
        <div class="col-md-4">
            <?php $attr = 'id="inputPostTemplate" class="form-control"'; ?>
            <?php echo form_dropdown('posttemplate',
                array('welcome_page' => 'Welcome Page',
                    'primary_page' => 'Primary Page',
                    'secondary_page' => 'Secondary Page',
                    'posts_by_category' => 'Posts by category',
                    'stuff_members_page' => 'Stuff members Page',
                    'posts_by_category_page' => 'Posts By Category'),$post->post_template,$attr ); ?>
        </div>
    </div>
    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputCategoryId">Category </label>
        <div class="col-md-4">
            <?php
            ($post->category_id == null) ? $categoryid = "0": $categoryid = $post->category_id;
            $attr = 'id="inputCategoryId" class="form-control"';
            echo form_dropdown('categoryid', $categories, $categoryid , $attr);
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-2 control-label" for="inputPublicationDate">Publication date </label>
        <div class="col-md-4">
            <?php
            ($post->publication_date == null) ? $publicationdate = "": $publicationdate = $post->publication_date;
            echo form_input('publicationdate', set_value('publicationdate', $post->publication_date ) ,'class="form-control datepicker" placeholder="Publication Date"'); ?>

        </div>
    </div>

    <div class="form-group" >
        <label class="col-md-2 control-label" for="inputContent">Post Content :</label>
        <div class="col-md-8">
            <textarea class="form-control" name="postcontent" id="inputContent" placeholder="type here ..." rows="3" ><?php echo $post->post_content?></textarea>
        </div>
    </div>

    <div class="form-group" >
        <div class="col-md-offset-2 col-md-4">
            <button type="submit" class="btn">Update</button>
        </div>
    </div>
<?php echo form_close();?>
<script>
    $("#inputPostIsActive").bootstrapSwitch("state",<?php echo $post->is_active;?> ).on('switchChange.bootstrapSwitch', function(event, state) {
        //   console.log(state); // true | false

        if(state){
            $("#hidden_is_active").val("1");
        }else{
            $("#hidden_is_active").val("0");
        }

    });



</script>
