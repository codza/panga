<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
    /**
     * MY_Form_validation::alpha_extra().
     * Alpha-numeric with periods, underscores, spaces and dashes.
     */
    function alpha_extra($str) {
        $this->CI->form_validation->set_message('alpha_extra', 'The %s may only contain alpha-numeric characters, spaces, periods, underscores & dashes.');
        return ( ! preg_match("/^([\.\s-a-z0-9_-])+$/i", $str)) ? FALSE : TRUE;
    }
    // add more function to apply custom rules.
   ///$this->form_validation->set_rules('name', 'Name', edit_unique[users.name.'. $user_id .']);
    public function edit_unique($value, $params)
    {
        $CI =& get_instance();
        $CI->load->database();

        $CI->form_validation->set_message('edit_unique', "Sorry, that %s is already being used.");

        list($table, $field, $current_id) = explode(".", $params);

        $query = $CI->db->select()->from($table)->where($field, $value)->limit(1)->get();

        if ($query->row() && $query->row()->user_id != $current_id)
        {
            return FALSE;
        }
    }




}