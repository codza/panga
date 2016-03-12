<?php
class Postmodel extends MY_Model {
	
	protected $_table_name = 'tbl_post';
	protected $_primary_key = 'post_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = 'post_order';
	protected $_rules = array();
	protected $_timestamps = TRUE;
   // protected $_media= array();
	
	function __construct() {
		parent::__construct();
        $this->load->model('dashboard/Categorymodel',"categorymodel");
        $this->load->model('dashboard/Mediamodel',"mediamodel");

	}
    public function get($id = null , $single = FAlSE){
        $this->db->select("$this->_table_name.* , us.first_name , us.last_name , us.username , cat.category_name");
        $this->db->join('tbl_category cat'," $this->_table_name.category_id = cat.category_id","LEFT");
        $this->db->join('tbl_user us'," $this->_table_name.user_id = us.user_id", "LEFT");
        $this->db->group_by("$this->_table_name.post_id","LEFT");
        $posts =  parent::get($id, $single);
   //   $posts->{"images"}= array();
     if( !is_array($posts) && !is_null($posts) ){
            $images = $this->mediamodel->get_by(array(
                "tbl_media.post_id" => $posts->post_id),TRUE);
            $posts->{'images'}= $images;
        }else if(is_array($posts) && !is_null($posts) ){
            foreach($posts as $i=> $post) {
                $images = $this->mediamodel->get_by(array("tbl_media.post_id"=>$post->post_id));
                $post->{"images"}= $images;
                $posts[$i]= $post;
            }
        }  /**/
        return $posts;
    }

    public function get_by($where, $single = FALSE){
        $this->db->where($where);
        return $this->get(NULL, $single);
    }



    public function get_with_parent ($id = NULL, $single = FALSE)
    {
        $this->db->select("$this->_table_name.*, p.post_slug as parent_slug, p.post_title as parent_title");
        $this->db->join("$this->_table_name as p", "$this->_table_name.parent_id = p.post_id", "left");
        return parent::get($id, $single);
    }


    public function get_nested ()
    {
        $posts = $this->db->order_by("post_order", "asc")->get($this->_table_name)->result_array();

        $array = array();
        foreach ($posts as $post) {
            if ($post['parent_id']==0) {
                $array[$post['post_id']] = $post;
            }else {
                $array[$post['parent_id']]['children'][] = $post;
            }
        }
     //   var_dump($array);
        return $array;
    }

    public function save_order ($posts)
    {
        if (count($posts)) {
            foreach ($posts as $order => $post) {
                if ($post['item_id'] != '') {
                    $data = array('parent_id' => (int) $post['parent_id'], 'post_order' => (int)$order);
                    $this->db->set($data)->where($this->_primary_key, $post['item_id'])->update($this->_table_name);
                   // echo "<pre>".$this->db->last_query()."</pre>";
                }
            }
        }
    }

    public function delete ($id)
    {
        // Delete a page
        parent::delete($id);

        // Reset parent ID for its children
        $this->db->set(array('parent_id' => 0 ))->where('parent_id', $id)->update($this->_table_name);
    }


    public function get_primary_posts(){
        $menu = $this->get_by( array(
        "$this->_table_name.post_type" => "primary_page",
        "$this->_table_name.is_active" => '1'
        ),FALSE);
        // echo "<pre>".$this->db->last_query()."</pre>";
        return $menu;
    }




    public function get_no_parents ()
    {
        // Fetch pages without parents
        $this->db->select('post_id, post_title');
        $this->db->where('parent_id', 0);
        $posts = parent::get();

        // Return key => value pair array
        $array = array(
            0 => ' -------- '
        );
        if (count($posts)) {
            foreach ($posts as $post) {
                $array[$post->post_id] = $post->post_title;
            }
        }

        return $array;
    }

    public function get_most_recent_post($np = 3){
        $this->db->limit($np);
        $this->db->order_by('created_date', 'DESC');

        return  $this->get_by(array(
            "$this->_table_name.post_type" => 'secondary_page',"$this->_table_name.is_active" => '1'),
            FALSE);
    }


    public $create_rules = array(
        'CategoryId' => array(
            'field' => 'categoryid',
            'label' => 'category',
            'rules' => 'trim|required'
        ),
        'UserId' => array(
            'field' => 'userid',
            'label' => 'User',
            'rules' => 'trim|required'
        ),
        'PostName' => array(
            'field' => 'postname',
            'label' => 'Post Name',
            'rules' => 'trim|required'
        ),
        'PostTitle' => array(
            'field' => 'posttitle',
            'label' => 'Post Title',
            'rules' => 'trim|required'
        ),
        'PostTemplate' => array(
            'field' => 'posttemplate',
            'label' => 'Post Template',
            'rules' => 'trim|required'
        ),
        'PostSlug' => array(
            'field' => 'postslug',
            'label' => 'Post Slug',
            'rules' => 'trim|max_length[100]|url_title|callback__unique_slug'
        ),
        'PostContent' => array(
            'field' => 'postcontent',
            'label' => 'Post Content',
            'rules' => 'trim|required'
        )
    );

    public $description_rules = array(

        'UserId' => array(
            'field' => 'userid',
            'label' => 'User',
            'rules' => 'trim|required'
        ),
        'PostSlug' => array(
            'field' => 'postslug',
            'label' => 'Post Slug',
            'rules' => 'trim|max_length[100]|url_title|callback__unique_slug'
        ),
        'PostKeywords' => array(
            'field' => 'postkeywords',
            'label' => 'Post Keywords',
            'rules' => 'trim'
        ),
        'PostDescription' => array(
            'field' => 'postdescription',
            'label' => 'Post Description',
            'rules' => 'trim'
        )
    );
}