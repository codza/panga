<?php if(count($main_post->images)>0 ){?>
<div class="container rhu_media_container">
    <div class="col-md-12 rhu_media_container_1">
       <div class="fill" style="background-image:url(<?php echo base_url("media/images/".$main_post->images->media_code.$main_post->images->media_ext );?>);"></div>
    </div>
</div>
<?php }?>