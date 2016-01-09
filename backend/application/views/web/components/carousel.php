
    <div id="rhu-Carousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $counter_init=0;?>
            <?php foreach ($posts as $post): ?>
            <li data-target="#rhu-Carousel" data-slide-to="<?php echo $counter_init; ?>" class="<?php echo $counter_init ==0 ?  "active" : ""; ?>"></li>
                <?php $counter_init++; ?>
            <?php endforeach; ?>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php $counter_init=0;?>
            <?php foreach ($posts as $post): ?>

            <div class="item <?php echo $counter_init ==0 ?  "active" : ""; ?>">
                <div class="fill" style="background-image:url(<?php echo base_url("media/images/".get_post_image_url($post));?>);"></div>
                <div class="carousel-caption text-left">
                    <div class="text-left" style="width: 100%;">
                        <a class="rhu_post_intro" href="<?php echo post_url($post)?>">
                        <h1 class=""><?php echo $post->post_title;?></h1>
                        </a>
                        <p >
                            <?php echo html_entity_decode(text_trunk($post->post_content, 25)); ?>
                            <a href="<?php echo post_url($post)?>">read more</a>
                        </p>
                    </div>

                </div>
            </div>
                <?php $counter_init++; ?>
            <?php endforeach; ?>

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#rhu-Carousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#rhu-Carousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </div>
