<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Loadedposts extends REST_Controller
{
    var $resp=[];
    var $status=[
        1=>array("status"=> "success"),
        2=>array("status"=> "error"),
    ];
    var $response_message=[
        1=>array("message"=> "no token provided!"),
        2=>array("message"=> "authentication error!"),
        3=>array("message"=> "Missing Argument!"),
        4=>array("message"=> "No result!")
    ];
    var $request_user;
    public function __construct ()
    {
        parent::__construct();
///        $this->load->model('dashboard/postmodel');
        $this->load->model('dashboard/usermodel');
        $this->load->model('dashboard/loadedpostmodel');
        $this->resp=  array();
        $tk=null;
        $users = null;

        if($this->get('tk')){
            $tk = $this->get("tk");
        }
        if($this->post('tk')){
            $tk = $this->post("tk");
        }
        if(is_null($tk)){
            $this->response(array(
               $this->status[2],$this->response_message[1] 
            ), 200);
        }
        $this->request_user = $this->usermodel->getUserByToken( $tk );
        if(!$this->request_user){
            $this->response(array(
               $this->status[2],$this->response_message[2]
                    ), 200);
        }
        
        

    }


    /**
     * @return all post
     *
     */
    function index_get(){
//        $users = $this->user_model->get_all();
        $posts = $this->postmodel->get();
        if($posts){
            $this->response($posts, 200);
        }else{
            $this->response(NULL, 404);
        }
    }

    function posts_get()
    {

        $posts = $this->postmodel->get();
        if($posts){
            $this->response($posts, 200);
        }else{
            $this->response(NULL, 404);
        }
        
    }

/*    function index(){
        $users = $this->usermodel->get();
        $this->response("hello world");
    }*/

    function by_get()
    {

        //    $this->response("hello world");
        $post_id =0;
       // $this->get('post_id');

        $posts =[];


      if(!$this->get('post_id') )
        {
            $this->response(array(
                $this->status[2],$this->response_message[3]), 400);
        }

        if($this->get('post_id') ){

            $post_id = $this->get('post_id');

            $posts = $this->loadedpostmodel->get_loaded_post_by_post_id($post_id );

        }

        $post_resp = ["data"=>$posts];


        if($posts){
            $this->response(array(
                $this->status[1],$post_resp), 200); // 200 being the HTTP response code
        }else{
            $this->response(array(
                $this->status[1], ["posts"=>"No Result"]
            ), 200);
        }
    }
    function async_loadpost_post() {
        
    //    $user_id = null;
        $post_id = null;
        $loaded_post_id = null;
        $post = null;
        $resp =null;

        //  $resp = null;
    //    $user_id = (int) $this->post('user_id');
        $post_id =  $this->post('post_id');
        $loaded_post_id = $this->post('loaded_post_id');/**/
        
    /*    $resp = array("post_id"=>$post_id,
            "loaded_post_id"=>$loaded_post_id,
            "user_id" =>$this->request_user->user_id);*/

        if (is_null($post_id) || is_null($loaded_post_id) ) {
          
            $this->response(array(
                $this->status[2],$this->response_message[3]), 200);
        }
        
        
        $datatoinsert = array("post_id" =>(int) $post_id, "user_id" => (int) $this->request_user->user_id, "loaded_post_id" => (int) $loaded_post_id);
        $vid_lik_id = $this->loadedpostmodel->save($datatoinsert);

        


    $data = $this->loadedpostmodel->get_loaded_post_by_post_id($post_id);

        $resp = [
            'status' => 'success','data'=>$data
        ];

        if ($resp) {
            $this->response($resp, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function async_unloadloadpost_post() {
        
        $loaded_id = null;
        $status ="success";
    
        $resp =null;


        $loaded_id = $this->post('loaded_id');/**/


        if (is_null($loaded_id) ) {
          
            $this->response(array(
                $this->status[2],$this->response_message[3])
                    ,200);
        }
        
        $loadedpost = $this->loadedpostmodel->get($loaded_id);
        
        //$datatoinsert = array("post_id" =>(int) $post_id, "user_id" => (int) $this->request_user->user_id, "loaded_post_id" => (int) $loaded_post_id);
        $loadedelete = $this->loadedpostmodel->delete($loaded_id);
        $data = $this->loadedpostmodel->get_loaded_post_by_post_id($loadedpost->mp_post_id);

       if(!$loadedpost){
           $status="failed";
       }
        $resp = [
            'status' => $status ,'data'=>$data
        ];

        if ($resp) {
            $this->response($resp, 200);
        } else {
            $this->response(NULL, 404);
        }
    }



}
