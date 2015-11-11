<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 11.11.2015 г.
 * Time: 16:16 ч.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_DB extends  CI_Migration{

    public function create(){
        $this->load->dbforge();
        $this->dbforge->create_database('blog');
    }
}