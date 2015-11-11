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
    }

    public function  index(){
            $this->load->view('contact_form');
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
                'rules' => 'trim|required|min_length[3]|max_length[30]'
            ),
            array(
                'field' => 'tel',
                'label' => 'Phone',
                'rules' => 'trim|required|exact_length[10]|numeric'
            ),
            array(
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|min_length[10]|max_length[30]|valid_email'
            ),
            array(
                'field' => 'mssg',
                'label' => 'Message',
                'rules' => 'trim|required|min_length[5]'
            )
        );

        $this->form_validation->set_rules( $FormRules );

        if ($this->form_validation->run() == TRUE) {
            echo '<div class="msg success">Your message was send successfully!</div>';

            $this->load->library("email");

            $this->email->from(set_value("email"), set_value("name"));
            $this->email->to("todorova.reni93@gmail.com");
            $this->email->subject("Message from form");
            $this->email->message(set_value("message"));

            $this->email->send();
            echo $this->email->print_debugger();


        } else {
            echo '<div class="msg error">' . validation_errors() . '</div>';
        }
    }
        public function sendEmail(){
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $phone_number = $this->input->post('tel');
            $message = $this->input->post('mssg');

            $this->load->library('email');
            $this->email->from($email, $name);
            $this->email->to('todorova.reni93@gmail.com');
            $this->email->subject('Email Test');
            $this->email->message(
                'My name is'.$name.', Im testing this email class. My email is '.$email. '. My Phone number is '.$phone_number.
                ' This is my message '.$message. ' Thanks!!'
            );
            $this->email->send();
            echo $this->email->print_debugger();
            $this->template->build('contact');
    }

}