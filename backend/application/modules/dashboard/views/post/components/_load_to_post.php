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
<div class="col-lg-7" id="loaded_post_list" style="border: 1px solid #000;">
    <table class="table" id="loaded_posts_list">
        <thead>
        <tr>
            <td> ID </td><td> Post Name</td><td> </td>
        </tr>
        </thead>
        <tbody>

		<tr>
			<td colspan="3"> No post could be found </td>
		</tr>


        </tbody>
        
    </table>
    
</div>




<script>
    $(function() {
    /*********************************************/
        var RESSOURCES_LOADEDPOSTS_BY_URL ="<?php echo RESSOURCES_LOADEDPOSTS_BY_URL; ?>";
        var tk="<?php echo $this->tokenSession;?>";
        var post_id ="<?php echo $post->post_id; ?>";


        RESSOURCES_LOADEDPOSTS_BY_URL +="/post_id/"+post_id+"/tk/"+tk+"/format/json";
        console.log(RESSOURCES_LOADEDPOSTS_BY_URL);

        $('#loaded_posts_list tbody tr').load(RESSOURCES_LOADEDPOSTS_BY_URL ,function(resp){

        ///    var var_resp = JSON.parse(resp);

            if (resp[0].status == "success") {
                var items = resp[1].data;
                load_post_list(items);
            }
        });


        ///////////////////




    $("#inputSearchPost").keypress(function(){
        var inputSearchPost =$("#inputSearchPost").val();
        var URL ="<?php echo RESSOURCES_POSTS_URL;?>";
        var tk  ="<?php echo $this->tokenSession;?>";
        if(inputSearchPost.trim().length >= 2){
            $.ajax({
                method: "GET",
                url: URL+"/by/name/"+inputSearchPost+"/tk/"+tk+"/format/json"
            }).done(function( resp ) {
             //   console.log(resp.posts);
            //    console.log(resp.posts);
               // console.log(resp.status);

                var items = resp[1].data;
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

          /*   */  $(".add_too_post").click(function (e) {
                    var RESSOURCES_POSTS_URL_LOAD_TO_POST = "<?php echo RESSOURCES_POSTS_URL_LOAD_TO_POST; ?>";
                    var post_to_load_id = $(this).data("newlineLoadedpostid");
                    var postData = new FormData();
                    var post_id = "<?php echo $post->post_id; ?>";
                    var tk      = "<?php echo $this->tokenSession; ?>";
                    postData.append("tk", tk);
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
                    }).done(function (resp) {

                        var Var_resp = JSON.parse(resp);
                        //console.log(resp);
                        console.log("/////////////////////////////");
                        console.log(Var_resp);
                        console.log("/////////////////////////////");


                        if (Var_resp.status === "success") {


                            var items = Var_resp.data;
                            //.html(): Clean HTML inside and append
                            $("#loaded_posts_list tbody tr").remove();
                            for (var i = 0; i < items.length; i++) {
                                $("#loaded_posts_list tbody").append(
                                    //   "<div class=''style='border:2px solid #000;'>" +
                                    "<tr>" +
                                    "<td>" + items[i].sp_post_id + "</td>" +
                                    "<td>" + items[i].sp_post_name + "</td>" +
                                    "<td><a class='remove_too_post' data-newline-loadedid='" + items[i].loaded_id + "' data-newline-tokensession='' href='<?php echo base_url() . "ressources/posts/async_unlaod/tk/" . $this->tokenSession . "loaded_id/";?>/format/json' >remove</a></td>" +
                                    "</tr>");

                            }
                            /*    $(".remove_too_post").click(function (x) {
                             x.preventDefault();
                             var loaded_id = $(this).data("newlineLoadedid");
                             var tokenSession = $(this).data("newlineTokensession");
                             var url = $(this).attr('href');
                             var postData = new FormData();

                             postData.append("loaded_id", loaded_id);
                             postData.append("tk", tokenSession);
                             // postData.append("loaded_post_id", post_to_load_id);

                             $.ajax({
                             datatype: "json",
                             mimeType: "multipart/form-data",
                             contentType: false,
                             cache: false,
                             processData: false,
                             method: "POST",
                             url: url,
                             data: postData
                             }).done(function (resp) {

                             var Var_resp = JSON.parse(resp);

                             if (Var_resp.status === "success") {

                             var items = Var_resp.data;
                             load_perm_list(items);
                             }

                             });



                             ///location.reload();
                             });*/
                        }

                    });
                    e.preventDefault();
                    console.log("********************************");

                });


            });
        }

    });

    /*********************************************/

        function load_perm_list( items ){
            $("#role_perm_list tbody tr").remove();
            for( var i=0; i < items.length; i++) {
                $("#role_perm_list tbody").append(
                    //   "<div class=''style='border:2px solid #000;'>" +
                    "<tr>"+
                    "<td>"+items[i].sp_post_id+"</td>" +
                    "<td>"+items[i].sp_post_name+"</td>"+
                    "<td><a class='remove_permission' data-newline-rolepermid='"+items[i].sp_post_id+"' data-newline-tokensession='<?php echo $this->tokenSession; ?>' href='<?php echo base_url()."ressources/roleperms/async_removepermtorole/format/json"; ?>'> remove</a></td>"+
                    "</tr>");

            }

            $(".remove_permission").click(function (e) {
                e.preventDefault();
                var role_perm_id = $(this).data("newlineRolepermid");
                var tokenSession = $(this).data("newlineTokensession");
                var url = $(this).attr('href');
                var postData = new FormData();

                postData.append("role_perm_id", role_perm_id);
                postData.append("tk", tokenSession);
                // postData.append("loaded_post_id", post_to_load_id);

                $.ajax({
                    datatype: "json",
                    mimeType: "multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    method: "POST",
                    url: url,
                    data: postData
                }).done(function (resp) {

                    var Var_resp = JSON.parse(resp);

                    if (Var_resp.status === "success") {

                        var items = Var_resp.data;
                        load_perm_list(items);
                    }

                });

                console.log("********************************");

            });



        }



    /*********************************************/
    });

</script>