<?php if (!defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class Welcome extends CI_Controller
{
    private $logged_in;
    private $is_admin;

    public function  __construct()
    {
        parent::__construct();
        if ($this->session->userdata( 'logged_in' )) {
            $this->logged_in = true;
        } else {
            $this->logged_in = false;
        }
        if ($this->session->userdata( 'is_admin' )) {
            $this->is_admin = true;
        } else {
            $this->is_admin = false;
        }
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'home', array( 'logged_in' => $this->logged_in ) );
        $this->load->view( 'inc/footer' );
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */