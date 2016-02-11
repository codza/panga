<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roleperms extends REST_Controller
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
        $this->load->model('dashboard/permissionmodel');
        $this->load->model('dashboard/rolepermmodel');
        $this->load->model('dashboard/rolemodel');
        $this->load->model('dashboard/usermodel');
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
    function roles_get()
    {

        $roles = $this->rolemodel->get();
        if($roles){
            $this->response($roles, 200);
        }else{
            $this->response(NULL, 404);
        }

    }

    function role_get()
    {
    //    $this->response("hello world");

        if(!$this->get('id'))
        {
            $this->response(array(
                $this->status[2], $this->response_message[3]
                    ),200);
        }

        $role = $this->rolemodel->get( $this->get('id') );

        if($role){
            $this->response(array(
                   $this->status[1],"data"=> $role ), 200); // 200 being the HTTP response code
        }else{
            $this->response(array(
                $this->status[2],$this->response_message[4]
            ), 200);
        }
    }
    
    function permission_by_get()
    {

        //    $this->response("hello world");
        $searchColumn = "";
        $searchTerm   = "";
        $resp_data = "";

      if(!$this->get('perm_name') && !$this->get('role_id')  ){
            $this->response(array(
                $this->status[2],$this->response_message[3]), 400);
        }
        /* */

        if($this->get('perm_name')){
            $searchColumn .="perm_name";
            $searchTerm = urldecode($this->get('perm_name'));
            $resp_data = $this->permissionmodel->get_where_like($searchColumn , $searchTerm, false  );
        }

        if($this->get('role_id')){
            $searchTerm = urldecode($this->get('role_id'));
            $resp_data = $this->rolepermmodel->get_perms_by_role_id($searchTerm);

        }

     ///   $resp_data = $this->permissionmodel->get_where_like($searchColumn , $searchTerm, false  );

        $perm_resp = ["data"=>$resp_data];

        if($resp_data){
            $this->response(array(
                $this->status[1],$perm_resp), 200); // 200 being the HTTP response code
        }else{
            $this->response(array(
                $this->status[1], ["data"=>"No Result"]
            ), 200);
        }
    }


    function async_addpermtorole_post() {

        $perm_id = null;
        $role_id = null;

        $resp =null;

        $perm_id =  $this->post('perm_id');
        $role_id = $this->post('role_id');

        if (is_null($perm_id) || is_null($perm_id) ) {
          
            $this->response(array(
                $this->status[2],$this->response_message[3]), 200);
        }
        
        
        $datatoinsert = array("perm_id" =>(int) $perm_id, "role_id" => (int) $role_id);
        $role_perm_id = $this->rolepermmodel->save($datatoinsert);

        $data = $this->rolepermmodel->get_perms_by_role_id($role_id);

        $resp = [
            'status' => 'success','data'=>$data
        ];

        if ($resp) {
            $this->response($resp, 200);
        } else {
            $this->response(NULL, 404);
        }
    }
    
    function async_removepermtorole_post() {
        
        $loaded_id = null;
        $status ="success";
    
        $resp =null;


        $role_perm_id = $this->post('role_perm_id');/**/
        
    /*    $resp = array("post_id"=>$post_id,
            "loaded_post_id"=>$loaded_post_id,
            "user_id" =>$this->request_user->user_id);*/

        if (is_null($role_perm_id) ) {
          
            $this->response(array(
                $this->status[2],$this->response_message[3])
                    ,200);
        }
        
        $roleperm = $this->rolepermmodel->get($role_perm_id);
        

        $rolepermdelete = $this->rolepermmodel->delete($role_perm_id);

        $data = $this->rolepermmodel->get_perms_by_role_id($roleperm->role_id);

       if(!$rolepermdelete){
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
