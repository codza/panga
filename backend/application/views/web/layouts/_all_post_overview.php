<div class="rhu-overview-container">
    <div class="container rhu-overview-inner-container">
            <div class="col-md-12 rhu_posts " >

                <?php foreach ($posts as $post): ?>
                <div class="row rhu_post_card">
                    <div class="col-md-4">
                        <div href="" class="thumbnail">
                            <img src="<?php echo base_url("media/images/thumb/".$post->media_code."_thumb".$post->media_ext );?>"  class="" alt="...">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h1 ><?php echo html_entity_decode(text_trunk($post->post_title)); ?></h1>
                        <?php echo html_entity_decode(text_trunk($post->post_content),25); ?>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
    </div>
</div>