<?php
$this->load->view('web/components/media');
?>
<div class="container rhu-post-container">
    <div class="col-md-12 rhu_single_post_card">
        <h1><?php echo $post->post_title;?></h1>
        <div class="text-justify">
        <?php
        echo $post->post_content;
        ?>
        </div>

    </div>
</div>