<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 24.11.2015 г.
 * Time: 13:35 ч.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends  CI_Controller{
    private $logged_in;
    public  function  __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in')){
            $this->logged_in = true;
        }else{
            $this->logged_in = false;
        }
        $this->load->model('user_model');
    }

    public function index(){
        $data['title'] = 'Login';
        $data['logged_in'] =$this->logged_in;
        $this->load->view('inc/header',$data);
        $this->load->view('login_view');
        $this->load->view('inc/footer');
    }
    public function signup(){

        $FormRules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|strip_tags|xss_clean|min_length[3]|max_length[30]|required|is_unique[user.username]'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[5]|max_length[30]|valid_email|is_unique[user.email]'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|strip_tags|xss_clean|min_length[4]|max_length[20]|required|matches[pass]'
            ),
            array(
                'field' => 'pass',
                'label' => 'Confirm Password',
                'rules' => 'trim|strip_tags|xss_clean|required'
            )
        );
        $this->form_validation->set_rules($FormRules);

        if($this->form_validation->run() === FALSE){
            $data['title'] = 'Sign up';
            $data['heading'] = 'Create New Account';
            $data['logged_in'] =$this->logged_in;
            $this->load->view('inc/header', $data);
            $this->load->view('form_error');
            $this->load->view('signup_view');
            $this->load->view('inc/footer');
        }
        else{
            $data['title'] = 'Sign up';
            $data['heading'] = 'Create New Account';
            $data['logged_in'] =$this->logged_in;
            $this->load->view('inc/header', $data);
            $this->load->view('form_success');
            $this->load->view('signup_view');
            $this->load->view('inc/footer');
            $this->addUser();
        }
    }

    public function addUser(){
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //$password = sha1($this->config->item('salt') . $this->input->post('password'));

        $this->user_model->createUser($username, $password, $email);
    }

    public function login_user(){
        $FormRules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|strip_tags|xss_clean|min_length[3]|max_length[30]|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|strip_tags|xss_clean|min_length[4]|max_length[20]|required'
            )
        );
        $this->form_validation->set_rules($FormRules);

        if($this->form_validation->run() === FALSE){
            $data['title'] = 'Login';
            $data['heading'] = 'Please login';
            $data['logged_in'] =$this->logged_in;

            $this->load->view('inc/header', $data);
            $this->load->view('form_error');
            $this->load->view('login_view');
            $this->load->view('inc/footer');
        }
        else{
            $result = $this->user_model->authentication();
           switch($result){
               case 'logged_in':
                   redirect('/', location);
                   break;
               case 'incorrect_password':
                   $data['title'] = 'Login';
                   $data['heading'] = 'Please login';
                   $data['logged_in'] =$this->logged_in;
                   $this->load->view('inc/header', $data);
                   $this->load->view('login_view');
                   $this->load->view('inc/footer');
                   break;
               case 'not_activated':
                   $data['title'] = 'Login';
                   $data['heading'] = 'Please login';
                   $data['logged_in'] =$this->logged_in;
                   $this->load->view('inc/header', $data);
                   $this->load->view('login_view');
                   $this->load->view('inc/footer');
                   break;
               case 'user_not_found':
                   $data['title'] = 'Login';
                   $data['heading'] = 'Please login';
                   $data['logged_in'] =$this->logged_in;
                   $this->load->view('inc/header', $data);
                   $this->load->view('login_view');
                   $this->load->view('inc/footer');
                   break;
           }
        }
    }
    public function logout(){
        $this->session->userdata('');
        $data['title'] = 'Logout';
        $data['heading'] = 'Thank you for your visit. See you next time.';
        $data['logged_in'] ='';
        $this->load->view('inc/header', $data);
        $this->load->view('logout_view');
        $this->load->view('inc/footer');

    }

    public function send_verf_email(){


        $email = $this->input->post('email');

        $config = Array(
            'mail_type'=>'html',
            'protocol' => 'smtp',
            'smtp_host' =>  'ssl://in.mailjet.com',
            'smtp_port' => 465,
            'smtp_user' => '6b0347125ae34888a88281a6640b44a9',
            'smtp_pass' => '77d2ed1f01c1995d70d1daea862a3574',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap' => TRUE
        );


        $this->load->library('email', $config);
        $this->email->from($this->config->item('bot_email'));
        $this->email->to($email);
        $this->email->subject('Verification Email');
        $this->email->message('Name: ');
        $this->email->send();
    }
}