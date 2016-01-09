<?php if(count($post->images)>0 ){?>
<div class="container rhu_media_container">
    <div class="col-md-12 rhu_media_container_1">
       <div class="fill" style="background-image:url(<?php echo base_url("media/images/".$post->images[0]->media_code.$post->images[0]->media_ext );?>);"></div>
    </div>
</div>
<?php }?>