<?php
$this->load->view('web/components/media');



?>
<div class="rhu-overview-container">
    <div class="container rhu-overview-inner-container">
        <div class="col-md-12 rhu_posts " >

            <?php foreach ($posts as $post): ?>
                <div class="row rhu_post_card">
                    <div class="col-md-3">
                        <div class="thumbnail rhu_thumbnail pull-right ">
                            <a href="<?php echo base_url(post_url($post));?>">
                                <div style="background-image:url(<?php echo base_url("media/images/thumb/".get_post_image_url($post,true));?>);"
                                     class="fill rhu_image_thumbnail" alt="<?php echo $post->post_name?>"></div>
                            </a>
                        </div>
                    </div>

                    <div class="col-md-9 text-justify rhu_post_intro">
                        <h2 >
                            <a class="" href="<?php echo base_url(post_url($post));?>">
                                <?php echo html_entity_decode(text_trunk($post->post_title)); ?>
                            </a>
                        </h2>
                        <p>
                            <?php echo html_entity_decode(text_trunk($post->post_content,30));?>
                        </p>
                        <p>
                            <a href="<?php echo base_url(post_url($post));?>">read more</a>
                        </p>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>