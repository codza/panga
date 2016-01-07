<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration extends CI_Controller {
    public function __construct() {
        parent::__construct();
		
    }

    public function index() {
        $this->load->library('migration');

        if (!$this->migration->current()) {

            show_error($this->migration->error_string());
            echo "There was a error migration worked";
        } else {

            echo "<center>the migration worked";
            $this->load->helper('file');
            // $config_file_URL =  base_url().'config.txt';
            $config_file_URL = './config.txt';
            // $file = file_get_contents($config_file_URL, FILE_USE_INCLUDE_PATH);

            $file = read_file($config_file_URL);
            $converted = explode("\n", $file);

            $this->load->model('usermodel');


            $hashpass = $this->usermodel->hash($converted[5]);
            $datatoinsert = array(
                'last_name' => trim($converted[0]),
                'first_name' => trim($converted[1]),
                'email' => trim($converted[2]),
                'username' =>trim($converted[3]),
                'user_role' =>trim($converted[4]) ,
                'password' =>trim($hashpass)
            );

            $id = 1;

            $check_admin_zero = $this->usermodel->get($id);

            if (count($check_admin_zero)) {
                echo "<br/>**************************<br/>";
                echo "*******************************<br/>";
                echo "* SUPER ADMINISTRATOR CREATED *<br/>";
                echo "***** You can now login   *****<br/>";
                echo "<br>***************************<br/>";
           //     if (unlink($config_file_URL)) {
           //         echo 'deleted successfully ';
           //     } else {
           //         echo 'errors occured';
           //     }
                
            } else {

                echo "<br/>*******************************<br/>";
                echo "*******************************<br/>";
                $this->usermodel->save($datatoinsert);
                echo "PROCESSING DONE<br/>";

                echo 'ADMINISTRATOR SUCCESSFULLY CREATED<br>';
            }
            echo '</center>';
        }
    }

}
