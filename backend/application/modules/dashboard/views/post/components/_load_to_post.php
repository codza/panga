<?php
$attributes = array('class' => 'form-horizontal');
?>

    <?php echo validation_errors(); ?>

<div class="col-lg-5">
    <!--form -->
    <div class="col-lg-12" style="border:1px solid #000;">
        <?php echo form_open(current_url(),$attributes);?>
            <div class="form-group" >
                <label class="col-lg-2 control-label" for="inputSearchPost">Post :</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputSearchPost" name="postsearch" value="" placeholder="Type To Search ..." />
                </div>
            </div>
        <?php echo form_close();?>
    </div>
     <!--end of form -->
     <!-- result area -->
    <div class="container col-lg-12" id="result">

    </div>
     <!-- end result-->
</div>

 


<script>
    $(function() {
    /*********************************************/


    $("#inputSearchPost").keypress(function(){
        var inputSearchPost =$("#inputSearchPost").val();
        var URL ="<?php echo RESSOURCES_POSTS_URL;?>";
        var tk  ="<?php echo $this->tokenSession;?>";
        if(inputSearchPost.trim().length >= 2){
            $.ajax({
                method: "GET",
                url: URL+"/by/name/"+inputSearchPost+"/tk/"+tk+"/format/json"
            }).done(function( resp ) {
                console.log(resp.posts);
               // console.log(resp.status);

                var items = resp.posts;
                //.html(): Clean HTML inside and append

                for( var i=0; i < items.length; i++) {
                    $("#result").html(
                     //   "<div class=''style='border:2px solid #000;'>" +
                        "<div class='col-lg-1'>"+items[i].post_id+"</div>" +
                        "<div class='col-lg-7'>"+items[i].post_title+"</div>" +
                        "<div class='col-lg-4'><a class='add_too_post' data-newline-loadedpostid='"+items[i].post_id+"' href='#'>add to related</a>"+"</div>"/*+
                        "</div>"*/);
                   /// console.log();
                }

          /*  */    $(".add_too_post").click(function () {
                    var RESSOURCES_POSTS_URL_LOAD_TO_POST = "<?php echo RESSOURCES_POSTS_URL_LOAD_TO_POST; ?>";
                    var post_to_load_id = $(this).data("newlineLoadedpostid");
                    var postData = new FormData();
                    var post_id = "<?php echo $post->post_id; ?>";
                    var user_id = "<?php echo $this->userSession->user_id; ?>";
                    postData.append("user_id", user_id);
                    postData.append("post_id", post_id);
                    postData.append("loaded_post_id", post_to_load_id);
                    console.log("********************************");
                    $.ajax({
                        datatype: "json",
                        mimeType: "multipart/form-data",
                        contentType: false,
                        cache: false,
                        processData: false,
                        method: "POST",
                        url: RESSOURCES_POSTS_URL_LOAD_TO_POST,
                        data: postData
                    }).done(function (data) {

                        var resp = JSON.parse(data);

                        if (resp.status === "success") {
                            console.log(resp);
                        }

                    });
                    console.log("********************************");

                });


            });
        }

    });

    /*********************************************/



    /*********************************************/
    });

</script>