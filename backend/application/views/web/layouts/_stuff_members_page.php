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

            <div class="container-fluid rhu_staff_members">

                <div class="row">

                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo base_url("media/images/members/m-jk.jpg" );?>" alt="...">
                            <div class="caption text-center">
                                <h4>Jean-luc Kasyano</h4>
                                <h5>Field Director</h5>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo base_url("media/images/members/m-is.jpg" );?>" alt="...">
                            <div class="caption text-center">
                                <h4>Nsubuga Ibrahim Saad</h4>
                                <h5>Projects Director</h5>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo base_url("media/images/members/m-na.jpg" );?>" alt="...">
                            <div class="caption text-center">
                                <h4>Nalubega Aidah</h4>
                                <h5>Senior Counselor</h5>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="<?php echo base_url("media/images/members/m-nl.jpg" );?>" alt="...">
                            <div class="caption text-center">
                                <h4>Ngbagaro Lodza</h4>
                                <h5>Web Designer</h5>
                            </div>
                        </div>
                    </div>

                </div>




            </div>


        </div>






</div>
