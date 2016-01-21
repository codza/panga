<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends REST_Controller
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
        $this->load->model('dashboard/postmodel');
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
    function post_get()
    {

    //    $this->response("hello world");

        if(!$this->get('id'))
        {
            $this->response(array(
                $this->status[2], $this->response_message[3]
                    ),200);
        }

        $post = $this->postmodel->get( $this->get('id') );

        if($post){
            $this->response(array(
                   $this->status[1],"data"=> $post ), 200); // 200 being the HTTP response code
        }else{
            $this->response(array(
                $this->status[2],$this->response_message[4]
            ), 200);
        }
    }

    function by_get()
    {

        //    $this->response("hello world");
        $searchColumn = "";
        $searchTerm   = "";

      if(!$this->get('id') && !$this->get('name')  )
        {
            $this->response(array(
                $this->status[2],$this->response_message[3]), 400);
        }
        /* */

        if($this->get('id') ){
            $searchColumn .="post_id";
            $searchTerm = $this->get('id');
        }
        if($this->get('name')){
            $searchColumn .="post_name";
            $searchTerm = $this->get('name');
        }

        $posts = $this->postmodel->get_where_like($searchColumn , $searchTerm, false  );

        $post_resp = ["posts"=>$posts];

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
        
        $resp = array("post_id"=>$post_id,
            "loaded_post_id"=>$loaded_post_id,
            "user_id" =>$this->request_user->user_id);

        if (is_null($post_id) || is_null($loaded_post_id) ) {
           // $this->response($resp, 200);
            $this->response(array(
                $this->status[2],$this->response_message[3]), 200);
        }
        
        
            $datatoinsert = array("post_id" =>(int) $post_id, "user_id" => (int) $this->request_user->user_id, "loaded_post_id" => (int) $loaded_post_id);
             $vid_lik_id = $this->loadedpostmodel->save($datatoinsert);

        


  /*   $data = $this->loadedpostmodel->get_loaded_post_by_post_id($post_id);

        $resp = [
            'status' => 'success','data'=>$data
        ];

        if ($resp) {
            $this->response($resp, 200);
        } else {
            $this->response(NULL, 404);
        }*/
        
        $this->response($resp, 200);
    }
    



}
