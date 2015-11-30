<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 30.11.2015 г.
 * Time: 19:38 ч.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends  CI_Controller{
     public function __construct(){
         parent:: __construct();

         if($this->session->userdata('logged_in')){
             $this->logged_in = true;
         }else{
             $this->logged_in = false;
             redirect(site_url()."/login");
         }
         $this->load->model('post_model');
         $this->load->model('user_model');
         $this->load->model('comment_model');
     }
    public function index(){

    }
}