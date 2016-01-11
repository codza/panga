
    <div class="col-lg-1">

    </div>
    <div class="col-lg-9">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#PostContent">Post Content</a></li>
            <li ><a href="#MediaPost">Media Post</a></li>
            <li ><a href="#LoadToPost">load to post</a></li>
            <li ><a href="#OtherPostSettings">Other Post Settings</a></li>
        </ul>
        <div class="tab-content">

            <div id="PostContent" class="tab-pane fade in active">
                <div class="container">
                    <?php $this->load->view('dashboard/post/components/_edit_form_post'); ?>
                </div>
            </div>

            <div id="MediaPost" class="tab-pane fade in ">
                <div class="container">
                    <?php $this->load->view('dashboard/post/components/_upload_media'); ?>
                </div>
              </div>

            <div id="LoadToPost" class="tab-pane fade in">
                <div class="container">
                    <?php $this->load->view('dashboard/post/components/_load_to_post'); ?>
                </div>
            </div>

            <div id="OtherPostSettings" class="tab-pane fade in">
                <div class="container">
                    <h1>Other Post Settings </h1>
                    <?php $this->load->view('dashboard/post/components/_edit_other_settings'); ?>
                </div>
            </div>

        </div>

        <div>
            <?php  echo anchor('admin/posts', 'Back To List ', 'title="posts list"');?>
        </div>
    </div>
    <div class="col-lg-2">


    </div>

<script>
    $(document).ready(function(){
        // Select first tab
      //  $('.nav-tabs a:first').tab('show');
        $(".nav-tabs a").click(function(e){
            e.preventDefault();
            $(this).tab('show');
        });

        $("ul.nav-tabs > li > a").on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        // on load of the page: switch to the currently selected tab
        var hash = window.location.hash;
        $('.nav-tabs a[href="' + hash + '"]').tab('show');
        //$('.nav-tabs a[href="#' + tabID + '"]').tab('show');



    });
</script>
