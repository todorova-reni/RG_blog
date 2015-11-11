<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 11.11.2015 г.
 * Time: 16:30 ч.
 */
class Migrate extends  CI_Controller{

    public function  __construct(){
        parent::__construct();if($this->input->is_cli_request() == FALSE){
            show_404();
        }
    }
    public function index(){


    }
}