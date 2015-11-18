<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:50 ч.
 */
defined('BASEPATH') OR exit('u no here');

class  Read extends  CI_Controller{
    public  function  __construct(){
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index(){

        // Get id from uri
        $id = $this->uri->segment(3);

        // Get data from model
        $data['post'] = $this->post_model->getById($id);

        // Load views
        $this->load->view('inc/header');
        $this->load->view('read_view', $data);
        $this->load->view('inc/footer');
    }
}