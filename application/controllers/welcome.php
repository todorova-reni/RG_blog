<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

    private $logged_in;
    public function  __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in')){
            $this->logged_in = true;
        }else{
            $this->logged_in = false;
        }
    }

	public function index()
	{   $data['title'] = 'Home';
        $data['logged_in'] =$this->logged_in;
        $this->load->view('inc/header', $data);
        $this->load->view('home', array('logged_in' =>$this->logged_in));
        $this->load->view('inc/footer');
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */