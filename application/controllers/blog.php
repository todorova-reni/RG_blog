<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 18.11.2015 г.
 * Time: 13:42 ч.
 */
if (!defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class  Blog extends CI_Controller
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
        $this->load->model( 'post_model' );
        $this->load->model( 'comment_model' );

    }

    public function index()
    {
        $this->load->library( 'pagination' );
        $data['title'] = 'Blog';
        $data['heading'] = 'Welcome To My Blog';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;

        $id = $this->uri->segment( 3 );
        $data['posts'] = $this->post_model->getAll( $id );

        $this->load->view( 'inc/header', $data );
        $this->load->view( 'blog_view', $data );
        $this->load->view( 'inc/footer' );
    }

    public function read()
    {
        $id = $this->uri->segment( 3 );
        $data['post'] = $this->post_model->getById( $id );
        if (empty( $data['post'] )) {
            show_404();
        }

        $this->post_model->increaseView( $id );

        $data['title'] = 'Single';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $data['comments'] = $this->comment_model->getByIdPost( $id );
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'read_view', $data );
        $this->load->view( 'inc/footer' );
    }

    public function submission()
    {
        $id = $this->uri->segment( 3 );
        $FormRules = array(
            array(
                'field' => 'comment',
                'label' => 'Comment',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[3]|max_length[255]'
            )
        );
        $this->form_validation->set_rules( $FormRules );

        if ($this->form_validation->run() === FALSE) {
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->load->view( 'inc/header', $data );
            $this->session->set_flashdata( 'error_comment', 'Your comment must contain at least 3 characters.' );
            redirect( '/blog/read/' . $id );
            $this->load->view( 'inc/footer' );
        } else {
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->addComment();
            $this->session->set_flashdata( 'success_comment', 'Your comment is posted.' );
            redirect( '/blog/read/' . $id, 'refresh' );
        }
    }

    public function addComment()
    {

        $id = $this->uri->segment( 3 );
        $body = $this->input->post( 'comment' );
        $author = $this->session->userdata( 'username' );

        $this->load->model( 'comment_model' );
        $this->comment_model->createComment( $body, $id, $author );

    }
}