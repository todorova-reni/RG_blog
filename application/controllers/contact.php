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

        $this->load->model('data_model');
        if(!$this->db->table_exists('email')){
            $this->data_model->addTable();
        }

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
            $this->clear_form();
            $this->create_record();

            $this->send_email();

        }
        else {
            echo '<div class="msg error">' . validation_errors() . '</div>';
        }
    }

    public function clear_form(){
        $this->_field_data = array();
        return $this;
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
        $toMail='myblogtest17@gmai.com';

          /* $config = Array(
               'protocol' => 'smtp',
               'smtp_host' =>  'ssl://in.mailjet.com',
               'smtp_port' => 587,
               'smtp_user' => '6b0347125ae34888a88281a6640b44a9',
               'smtp_pass' => '77d2ed1f01c1995d70d1daea862a3574',
               'mailtype' => 'html',
               'charset' => 'utf-8',
               'newline' => "\r\n",
               'wordwrap' => TRUE
                );*/
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'myblogtest17@gmai.com', // change it to yours
            'smtp_pass' => 'myblogtest', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->from($email, $name);
        $this->email->to($toMail);
        $this->email->subject('Email Test');
        $this->email->message($message . ' ' . $phone);
        $this->email->send();

    }
}