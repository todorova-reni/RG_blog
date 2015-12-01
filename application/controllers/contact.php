<?php
session_start();
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 10.11.2015 г.
 * Time: 14:58 ч.
 */
if (!defined( 'BASEPATH' )) exit( 'No direct script access allowed' );


class Contact extends CI_Controller
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
        $this->load->model( 'captcha_model' );
        $this->load->model( 'data_model' );
    }

    public function  index()
    {
        $data['title'] = 'Contact';
        $data['heading'] = 'Contact Form';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $captcha = $this->captcha_model->generateCaptcha();
        $_SESSION['captcha'] = $captcha['word'];

        $this->load->view( 'inc/header', $data );
        $this->load->view( 'contact_view', $captcha );
        $this->load->view( 'inc/footer' );
    }

    public function submission()
    {
        $FormRules = array(
            array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[3]|max_length[30]'
            ),
            array(
                'field' => 'tel',
                'label' => 'Phone',
                'rules' => 'trim|strip_tags|xss_clean|required|exact_length[10]|numeric'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[5]|max_length[30]|valid_email'
            ),
            array(
                'field' => 'mssg',
                'label' => 'Message',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[5]'
            ),
            array(
                'field' => 'captcha',
                'label' => 'Captcha',
                'rules' => 'trim|strip_tags|xss_clean|required|max_length[5]|callback_captchaCheck'
            )
        );

        $this->form_validation->set_rules( $FormRules );

        if ($this->form_validation->run() === FALSE) {
            $captcha = $this->captcha_model->generateCaptcha();
            $data['title'] = 'Contact';
            $data['heading'] = 'Contact Form';
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->load->view( 'inc/header', $data );
            $this->load->view( 'contact_view', $captcha );
            $this->load->view( 'inc/footer' );
            $_SESSION['captcha'] = $captcha['word'];
        } else {
            $_SESSION['captcha'] = '';
            $captcha = $this->captcha_model->generateCaptcha();
            $data['title'] = 'Contact';
            $data['heading'] = 'Contact Form';
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->load->view( 'inc/header', $data );
            $message = "Your message was sent successfully";
            $this->load->view( 'form_success', $message );
            $this->load->view( 'contact_view', $captcha );
            $this->load->view( 'inc/footer' );
            $this->create_record();
            $this->send_email();
        }
    }

    public function  captchaCheck()
    {
        if ($this->input->post( 'captcha' ) == $_SESSION['captcha']) {
            return true;
        } else {
            $this->form_validation->set_message( 'captchaCheck', 'Please enter the text from the image!' );
            return false;
        }
    }

    public function  create_record()
    {
        $name = $this->input->post( 'name' );
        $phone = $this->input->post( 'tel' );
        $email = $this->input->post( 'email' );
        $message = $this->input->post( 'mssg' );

        $this->load->model( 'data_model' );
        $this->data_model->createRecord( $name, $phone, $email, $message );
    }

    public function send_email()
    {
        $name = $this->input->post( 'name' );
        $phone = $this->input->post( 'tel' );
        $email = $this->input->post( 'email' );
        $message = $this->input->post( 'mssg' );
        $toMail = 'todorova.reni93@gmail.com';

        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://in.mailjet.com',
            'smtp_port' => 465,
            'smtp_user' => '6b0347125ae34888a88281a6640b44a9',
            'smtp_pass' => '77d2ed1f01c1995d70d1daea862a3574',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap' => TRUE
        );
        /*$config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'myblogtest17@gmai.com', // change it to yours
            'smtp_pass' => 'myblogtest', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );*/

        $this->load->library( 'email', $config );
        $this->email->from( $toMail );
        $this->email->to( $email );
        $this->email->subject( 'Email Test' );
        $this->email->message( 'Name: ' . $name . '<br>' . 'Phone: ' . $phone . '<br>' . 'Message: ' . $message );
        $this->email->send();
    }
}