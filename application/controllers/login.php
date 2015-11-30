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
    /*
     *-----------------------------------------------------------------
     *                         REGISTRATION
     *------------------------------------------------------------------
     */
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
            $message = 'Your registration is almost complete. We send you a verification email. Please follow the instructions';
            $data['title'] = 'Sign up';
            $data['heading'] = 'Create New Account';
            $data['logged_in'] =$this->logged_in;
            $this->load->view('inc/header', $data);
            $this->load->view('form_success', $message);
            $this->load->view('signup_view');
            $this->load->view('inc/footer');
            $this->addUser();
        }
    }

    public function addUser(){
        $username = $this->input->post('username');
        $email = $this->input->post('email');
        //$password = $this->input->post('password');
        $password = sha1($this->config->item('salt') . $this->input->post('password'));
        $verification_code = random_string('alnum',20);
        $this->send_verf_email($email, $verification_code);
        $this->user_model->createUser($username, $password, $email, $verification_code);
    }

    public function send_verf_email($email, $verification_code){

        $email_msg = "Dear User,
<p-->
Please click on below URL or paste into your browser to verify your Email Address.<p></p>";
        $email_msg .= "http://www.blog-reni.dev/index.php/login/verify/" .$verification_code;
        $email_msg .= "<p>Thanks, Support Team of blog-reni.dev</p>";

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
        $this->email->from($this->config->item('bot_email'),'Support Team');
        $this->email->to($email);
        $this->email->subject('Email Verification');
        $this->email->message($email_msg);
        $this->email->send();
    }

    public function verify($verificationText=NULL){
        $noOfRecords = $this->user_model->verifyEmailAddress($verificationText);
        if($noOfRecords > 0){
            redirect('login/');
            $message = "Email Verified Successfully! Please login below.";
            $this->load->view('form_success', $message);

        }else{
           $message = "Sorry! Unable to verify your email. Please try again";
            $this->load->view('form_error', $message);
            redirect('login/');
        }
    }


    /*
    *-----------------------------------------------------------------
    *                         LOGIN
    *------------------------------------------------------------------
    */

    public function login_user(){
        $remember = $this->input->post('remember');

        $FormRules = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'trim|strip_tags|xss_clean|required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|strip_tags|xss_clean|required|callback_verifyUser'
            )
        );
        $this->form_validation->set_rules($FormRules);

        if($this->form_validation->run() === FALSE){
            $data['title'] = 'Login';
            $data['heading'] = 'Please login';
            $data['logged_in'] =$this->logged_in;
            $message = 'Wrong username or password please try again.';

            $this->load->view('inc/header', $data);
            $this->load->view('form_error',$message);
            $this->load->view('login_view');
            $this->load->view('inc/footer');
        }
        else{
            $data = array(
                'username' =>  $this->input->post('username'),
                'logged_in' =>1
            );
            $this->session->set_userdata($data);
            redirect('/', location);
        }
    }

    public function  verifyUser(){
        $username = $this->input->post('username');
        $password = sha1($this->config->item('salt') . $this->input->post('password'));

        $this->load->model('user_model');
        if($this->user_model->getByUsernameAndPass($username,$password)){
            return true;
        }else{
            return false;
        }
    }

    public function logout(){
        delete_cookie('username');
        delete_cookie('password');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('email');

        $data['title'] = 'Logout';
        $data['heading'] = 'Thank you for your visit. See you next time.';
        $data['logged_in'] ='';

        $this->load->view('inc/header', $data);
        $this->load->view('home');
        $this->load->view('inc/footer');

    }

}