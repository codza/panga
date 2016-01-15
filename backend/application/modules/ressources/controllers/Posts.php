<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Posts extends REST_Controller
{
    var $response_errror=[
        1=>array("error"=> "no token provided!"),
        2=>array("error"=> "authentication error!"),
        3=>array("error"=> "Missing Argument!"),
        4=>array("error"=> "No result!")
    ];
    var $request_user;
    public function __construct ()
    {
        parent::__construct();
        $this->load->model('dashboard/postmodel');
        $this->load->model('dashboard/usermodel');
        $tk=null;
        $users = null;

        if($this->get('tk')){
            $tk = $this->get("tk");
        }
        if($this->post('tk')){
            $tk = $this->post("tk");
        }
        if(is_null($tk)){
            $this->response($this->$response_errror[1], 200);
        }
        $this->request_user = $this->usermodel->getUserByToken( $tk );
        if(!$this->request_user){
            $this->response($this->$response_errror[2], 200);
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
            $this->response($this->$response_errror[3], 400);
        }

        $post = $this->postmodel->get( $this->get('id') );

        if($post){
            $this->response($post, 200); // 200 being the HTTP response code
        }else{
            $this->response($this->response_errror[4], 404);
        }
    }

    function by_get()
    {

        //    $this->response("hello world");
        $searchColumn = "";
        $searchTerm   = "";

      if(!$this->get('id') && !$this->get('name')  )
        {
            $this->response($this->response_errror[3], 400);
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

        $post_resp = ["status"=>"success","posts"=>$posts];

        if($posts){
            $this->response($post_resp, 200); // 200 being the HTTP response code
        }else{
            $this->response(NULL, 404);
        }
    }
    function async_loadpost_post() {
        $post = null;
        $loaded_post = null;
        $u = 0;
        $ul = 1;
        $numberOfLikes = 0;
        $numberOfUnlikes = 0;
        //  $resp = null;
        $usertoken = $this->post('u_t');
        $v_id = (int) $this->post('v_id');
        $u_or_ul = (int) $this->post('u_or_ul');

        if (!$usertoken || !$v_id) {
            $this->response(NULL, 400);
        }

        if ($usertoken) {
            $user = $this->usermodel->getUserByToken($usertoken);
        }
        if ($v_id) {
            $video = $this->videomodel->get($v_id);
        }
        if ($user !== null || $video !== null) {
            $user_id = $user['user_id'];
            $datatoinsert = array("video_id" => $video->video_id, "user_id" => (int) $user_id, "liked_or_unliked" => (int) $u_or_ul);
            $vid_lik_id = $this->videolikedmodel->save($datatoinsert);
            $videos_liked = $this->videolikedmodel->get_liked_or_unliked_by_video_id($video->video_id, $u);
            $videos_unliked = $this->videolikedmodel->get_liked_or_unliked_by_video_id($video->video_id, $ul);
            $numberOfLikes = count($videos_liked);
            $numberOfUnlikes = count($videos_unliked);
        }
        $resp = ['status' => 'success',
            'video_likes' => $numberOfLikes,
            'video_unlikes' => $numberOfUnlikes
        ];

        if ($vid_lik_id) {
            $this->response($resp, 200);
        } else {
            $this->response(NULL, 404);
        }
    }



}
