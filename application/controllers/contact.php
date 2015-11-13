<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 10.11.2015 г.
 * Time: 14:58 ч.
 */
defined('BASEPATH') OR exit('u no here');


class Contact extends  CI_Controller{
    public function  __construct(){
        parent::__construct();

        $this->load->helper('captcha');
        $this->load->model('captcha_model');
        $this->load->model('data_model');
    }

    public function  index(){

        $data['image'] = $this->captcha_model->createCaptcha();

        $data['rows'] = $this->data_model->getAll();

        $this->load->view('contact_view', $data);
    }


    public function submission()
    {
        if (!$this->input->is_ajax_request()) {
            exit( 'no valid request' );
        }

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
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[10]|max_length[30]|valid_email'
            ),
            array(
                'field' => 'mssg',
                'label' => 'Message',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[5]'
            ),
             array(
                 'field' => 'captcha',
                 'label' => 'Captcha',
                 'rules' => 'trim|strip_tags|xss_clean|required|max_length[5]|callback_captchaCheck|match_captcha[captcha.word]'
             )
        );

        $this->form_validation->set_rules( $FormRules );

        if ($this->form_validation->run() === TRUE) {
            $this->load->view('form_success');
            $this->create_record();
            $this->load->view('contact_view');
            $this->send_email();
        }
        else {
            $data['image'] = $this->captcha_model->createCaptcha();
            $this->load->view('form_error');
        }
    }

    public function  captchaCheck($value){
        if($value == ''){
            $this->form_validation->set_message('captchaCheck','Please enter the text from the image');
            return false;
        }
        else{
            return true;
        }

    }
    public function  create_record(){

        $name = $this->input->post('name');
        $phone = $this->input->post('tel');
        $email = $this->input->post('email');
        $message = $this->input->post('mssg');

        $this->load->model('data_model');
        $this->data_model->createRecord($name, $phone, $email, $message);
    }

    public function send_email(){

        $name = $this->input->post('name');
        $phone = $this->input->post('tel');
        $email = $this->input->post('email');
        $message = $this->input->post('mssg');
        $toMail='todorova.reni93@gmail.com';

        $config = Array(
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

        $this->load->library('email', $config);
        $this->email->from($toMail);
        $this->email->to($email);
        $this->email->subject('Email Test');
        $this->email->message('Name: ' . $name .'<br>'.'Phone: ' . $phone . '<br>'. 'Message: ' . $message);
        $this->email->send();

    }
}