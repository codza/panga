<?php

class Usermodel extends MY_Model {

    protected $_table_name = 'tbl_user';
    protected $_primary_key = 'user_id';
    protected $_primary_filter = 'intval';
    protected $_order_by = 'user_id';
    protected $_timestamps = TRUE;

    function __construct() {
        parent::__construct();

    }
    public function get($id = NULL, $single = FALSE){
        return parent::get($id,$single);
    }

    function getAllButCurrentUser($ids=array('1')){
        /*
         $this->data['users'] = $this->usermodel->get_by(array(
         "user_id NOT IN(".implode(", ", $ids).") "=>NULL ,
            // $this->_table_name.".".$this->_primary_key." != "=>$id
             ),
                 FALSE);
        */
        $this->db->where_not_in($this->_table_name.".".$this->_primary_key, $ids);
        $users = parent::get();
       //  echo "<spam>".$this->db->last_query()."</spam>";
        return $users;
    }
    
    function getUserByEmail($email){
        $userAuth = null;
        $user = $this->get_by(array(
            'email' => $email            
                ), TRUE);
        if (count($user)){
            $userAuth = array(
                'user_id' => $user->user_id,
                'user_token'=> $user->user_token,
                'username' => $user->username,
                'email' => $user->email,
                'avatar_icon' => $user->avatar_icon,
                'logged_in' => TRUE,
            );
        }
        return $userAuth;
    }
    

    function getUserByToken($token) {
        $userAuth = null;
        $user = $this->get_by(array(
            'user_token' => $token            
                ), TRUE);
        
          if (count($user)){
            $userAuth = (Object)array(
                'user_id' => $user->user_id,
                'first_name' =>$user->first_name,
                'last_name' =>$user->last_name,
                'username' => $user->username,
                'email' => $user->email,
                'avatar_icon' => $user->avatar_icon,
                'user_role' =>$user->user_role,
            );
        }/**/
        return $userAuth;
    }

    public function authenticate($usr, $pwd) {
     //   $userAuth = null;
        $user = $this->get_by(array(
            'username' => $usr,
            'password' => $this->hash($pwd),
                ), TRUE);

    return $user;
    }

    public function getUserTokenByUsernameAndPassword($usr, $pwd) {
        $userAuth  = null;
        $user_token="";
        $user_id=0;
        $user = $this->get_by(array(
            'username' => $usr,
            'password' => $this->hash($pwd),
        ), TRUE);

        if (count($user)) {
            // authenticate user
            if ($user->user_token == NULL) {
                $toklen = 15;
                $user_token = RandomStringId($toklen);
                $tokenupdate = array("user_token" => $user_token);
                $user_id = $this->save($tokenupdate , (int) $user->user_id );

            }else{
                $user_token = $user->user_token;
            }


            $userAuth = array(
                'user_token'=>  $user_token,
                'logged_in' => TRUE,
            );
        }
        return $userAuth;
    }
    public function getUserRoleByUserID($user_id){
        $this->db->select("$this->_table_name.username, $this->_table_name.user_token, role.role_name");

        $this->db->join('tbl_role_perm role_perm'," $this->_table_name.user_role = role_perm.role_id","LEFT");

    }


    public function hash($string) {
        return hash('sha256', $string.config_item('encryption_key'));
    }




    public $rules = array(
        'FirstName' => array(
            'field' => 'firstname',
            'label' => 'First Name',
            'rules' => 'trim'
        ),
        'LastName' => array(
            'field' => 'lastname',
            'label' => 'Last Name',
            'rules' => 'trim'
        ),
        'UserName' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[tbl_user.username]'
        ),
        'Email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[tbl_user.email]'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        'confirmpassword' => array(
            'field' => 'confirmpassword',
            'label' => 'Confirm password',
            'rules' => 'trim|required|matches[password]'
        )
    );
    public $editrules = array(
        'FirstName' => array(
            'field' => 'firstname',
            'label' => 'First Name',
            'rules' => 'trim'
        ),
        'LastName' => array(
            'field' => 'lastname',
            'label' => 'Last Name',
            'rules' => 'trim'
        ),
        'Email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[tbl_user.email]'
        )
    );
    public $editpassword = array(
        'current_password' => array(
            'field' => 'current_password',
            'label' => 'Current Password',
            'rules' => 'trim'
        ),
        'new_password_1' => array(
            'field' => 'new_password_1',
            'label' => 'Password',
            'rules' => 'trim|required'
        ),
        'new_password_2' => array(
            'field' => 'new_password_2',
            'label' => 'Confirm password',
            'rules' => 'trim|required|matches[new_password_1]'
        )
    );
    public $newprofil = array(
        'UserName' => array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|is_unique[tbl_user.username]'
        ),
        'Email' => array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email|is_unique[tbl_user.email]'
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required'
        )
    );

}
