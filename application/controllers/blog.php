<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:42 ч.
 */
defined('BASEPATH') OR exit('u no here');

class  Blog extends  CI_Controller{
    public  function  __construct(){
        parent::__construct();
        $this->load->model('post_model');
    }

    public function index(){
        $this->load->library('pagination');
        $data['title'] = 'Blog';
        $data['heading'] = 'Welcome To My Blog';

        $config['base_url'] = 'http://localhost/Blog/RG_blog/index.php/blog/index';
        $config['total_rows'] = $this->db->get('post')->num_rows;
        $config['per_page'] = 5;
        $config['num_links'] = 10;
        $this->pagination->initialize($config);

        $data['query'] = $this->db->get('post', $config['per_page'], $this->uri->segment(3));

        $this->load->view('inc/header',$data);
        $this->load->view('blog_view', $data);
        $this->load->view('inc/footer');
    }

    public function read()
    {   $id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $this->db->set('views','views+1',FALSE);
        $this->db->update('post');

        $data['title'] = 'Single';

        $data['post'] = $this->post_model->getById($id);


        $this->load->view('inc/header',$data);
        $this->load->view('read_view', $data);
        $this->load->view('inc/footer');
    }


}