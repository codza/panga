<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rabc extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard/rolemodel');
        $this->load->model('dashboard/permissionmodel');
        $this->load->model('dashboard/rolepermmodel');

    }

    public function index() {
    //    $this->data['roles'] = $this->rolemodel->get();
    //    $this->data['subview'] = 'admin/role/_role_list';
        $this->load->view('dashboard/_rabc_layout', $this->data);
    }
    public function view_roles() {
        $this->data['roles'] = $this->rolemodel->get();
        $this->data['subview'] = 'dashboard/role/_role_list';
        $this->load->view('dashboard/_rabc_layout', $this->data);
    }
    public function view_permissions() {
        $this->data['permissions'] = $this->permissionmodel->get();
        $this->data['subview'] = 'dashboard/permission/_permission_list';
        $this->load->view('dashboard/_rabc_layout', $this->data);
    }

    public function add_role() {
        $datatoinsert = null;
        $rolename = '';
        if ($_POST) {
            $rolename = $this->input->post('rolename', true);
            $datatoinsert = array(
                'role_name' => $rolename,
            );
            $this->data["datatoinsert"] = $datatoinsert;
            $this->load->library('form_validation');
            $validationrules = $this->rolemodel->rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE) {
                $this->data['errors'] = 'form validation error';
            } else {
                $this->rolemodel->save($datatoinsert);
                redirect('dashboard/rabc/view_roles', 'refresh');
            }
        } else {
            $datatoinsert = array(
                'role_name' => $rolename
            );
            $this->data["datatoinsert"] = $datatoinsert;
        }
        $this->data['subview'] = 'dashboard/role/_new_role';
        $this->load->view('dashboard/_rabc_layout', $this->data);
    }

    public function edit_role($id = NULL) {
        if ($id) {
            $this->data['role'] = $this->rolemodel->get($id);
            if (count($this->data['role'])) {
                $this->data['roleperms'] = $this->rolepermmodel->get_perms_by_role_id($id);
                $this->data['subview'] = 'dashboard/role/_edit_role';
            } else {
                
            }
        }
        if ($_POST) {
            $rolename = $this->input->post('rolename', true);
            $rules = $this->rolemodel->rules;
            $rules['RoleName']['rules'] = 'trim|required|edit_unique[tbl_role.role_name.' . $rolename . ']';
            $this->load->library('form_validation');
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $datatoupdate = array(
                    "role_name" => $rolename
                );
                $data = $this->rolemodel->save($datatoupdate, $id);
                $this->data['role'] = $this->rolemodel->get($id);
                redirect('dashboard/rabc/view_roles');
            }/* */
        }

        $this->load->view('dashboard/_rabc_layout', $this->data);
    }

    public function delete_role($id) {
        $this->rolemodel->delete($id);
        redirect('dashboard/rabc/view_roles', 'refresh');
    }

    public function add_permission() {
        $datatoinsert = null;
        $permname = '';
        $permdesc = '';
        if ($_POST) {
            
            $permname = $this->input->post('permissionname', true);
            $permdesc = $this->input->post('permissiondescription', true);
            
            $datatoinsert = array(
                'perm_name' => $permname,
                'perm_desc' => $permdesc
            );
            $this->data["datatoinsert"] = $datatoinsert;
            $this->load->library('form_validation');
            $validationrules = $this->permissionmodel->rules;

            $this->form_validation->set_rules($validationrules);

            if ($this->form_validation->run() == FALSE) {
                $this->data['errors'] = 'form validation error';
            } else {
                $this->permissionmodel->save($datatoinsert);
                redirect('dashboard/rabc/view_permissions', 'refresh');
            }
        } else {
            $datatoinsert = array(
                'perm_name' => $permname,
                'perm_desc' => $permdesc
            );
            $this->data["datatoinsert"] = $datatoinsert;
        }
        $this->data['subview'] = 'dashboard/permission/_new_permission';
        $this->load->view('dashboard/_rabc_layout', $this->data);
    }

    public function edit_permission($id = NULL) {
        if ($id) {
            $this->data['permission'] = $this->permissionmodel->get($id);
            if (count($this->data['permission'])) {
                $this->data['subview'] = 'dashboard/permission/_edit_permission';
            } else {
                
            }
        }
        if ($_POST) {
            
            $permid = $this->input->post('permissionid', true);
            $permname = $this->input->post('permissionname', true);
            $permdesc = $this->input->post('permissiondescription', true);
            
            $rules = $this->permissionmodel->rules;
            $rules['PermissionName']['rules'] = 'trim|required|edit_unique[tbl_permission.perm_name.' . $permname . ']';
            $this->load->library('form_validation');
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                
            } else {
                $datatoupdate = array(
                    'perm_name' => $permname,
                    'perm_desc' => $permdesc
                );
                $this->permissionmodel->save($datatoupdate, $id);

                $this->data['permission'] = $this->permissionmodel->get($id);
                redirect('dashboard/rabc/view_permissions');
            }/* */
        }

        $this->load->view('dashboard/_rabc_layout', $this->data);
    }

    public function delete_permission($id) {
        $this->permissionmodel->delete($id);
        redirect('dashboard/rabc/view_permissions', 'refresh');
    }

}
