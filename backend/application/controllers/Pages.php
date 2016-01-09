<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends Frontend_Controller{

	function __construct() {
		parent::__construct();
	}

	public function index()
	{
        $this->data['related_category']="";

        $total_uri_segment = $this->uri->total_segments();

        $this->data['website_url_array'] = $this->uri->segment_array();

        $this->data['primary_posts'] = $this->postmodel->get_by( array("tbl_post.post_type" => 'primary_page'),FALSE);


      //  $this->data['posts'] = $this->postmodel->get(7);

      //  var_dump($this->data['posts']->images[0]);

      if($total_uri_segment < 2 ){

            $this->data['posts'] =  $this->postmodel->get_most_recent_post();

            $this->data['post'] = $this->postmodel->get_by(array(
                'tbl_post.post_slug' => (string) $this->uri->segment(1),
                'tbl_post.is_active' => 1
            ), TRUE);

            if($this->data['post'] != null ){

                if($this->data['post']->post_slug=="" ){

                    if( $this->data['post']->post_template == "welcome_page"){

                        $this->data["posts"]= $this->postmodel->get_most_recent_post();

                    }else{

                        $this->data['related_category'] = $this->data['post']->category_name;
                        $this->data['posts'] = $this->postmodel->get_by(
                            array("cat.category_name" =>$this->data['post']->category_name  )
                            ,
                            FALSE);

                    }


                }else{

                    if( $this->data['post']->post_template != "secondary_page"){
                        $this->data['posts'] = $this->postmodel->get_by(
                            array("cat.category_name" =>$this->data['post']->post_slug  )
                            ,
                            FALSE);
                    }else{
                        $this->data['posts'] = $this->postmodel->get_by(
                            array("cat.category_name" =>$this->data['post']->category_name  )
                            ,
                            FALSE);
                    }

                    $this->data['related_category'] =$this->data['post']->category_name;

                }
            }
          //  $this->data['related_category'] =$this->data['post']->category_name;


        }else{

            $this->data['related_category'] = (string) $this->uri->segment(1);
        //    var_dump($this->data['related_category']);

            $this->data['post'] = $this->postmodel->get_by( array(
                'category_name' => (string) $this->uri->segment(1),
                'tbl_post.post_slug' =>(string)$this->uri->segment(2) ),
                TRUE);


            if($this->data['post'] !== null){

                if(strcasecmp($this->data['post']->post_template,"welcome_page")==0 ){
                    $this->data['posts'] = $this->postmodel->get_most_recent_post();
            //        var_dump("test 2");

                }else{
                    $this->data['posts'] = $this->postmodel->get_by( array(
                        'category_name'=>(string) $this->uri->segment(1)
                    ),FALSE);
               //     var_dump("test 3");
               //     var_dump($this->data['post']->post_template);

                }

            }
        }
    //    var_dump($total_uri_segment);

    //    count($this->data['post']) || show_404(current_url());
        if(count($this->data['post'])==0){

            //$post_template  = '_' . $this->data['post']->post_template;
            $this->data['subview'] ='errors/page_404';

        }else{
         //   $method = '_' . $this->data['post']->post_template;
            $post_template  = '_' . $this->data['post']->post_template;
            $this->data['subview'] ='web/layouts/'.$post_template;

        }

        $this->load->view('web/_main_layout', $this->data);
	}



}
