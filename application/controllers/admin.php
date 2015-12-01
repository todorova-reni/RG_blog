<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 30.11.2015 г.
 * Time: 19:38 ч.
 */
if (!defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class Admin extends CI_Controller
{
    private $logged_in;
    public function __construct()
    {
        parent:: __construct();

        if ($this->session->userdata( 'logged_in' )&& $this->session->userdata( 'is_admin' )) {
            $this->logged_in = true;
            $this->is_admin = true;
        } else {
            $this->logged_in = false;
            redirect( '/', location );
        }
        $this->load->model( 'post_model' );
        $this->load->model( 'user_model' );
        $this->load->model( 'comment_model' );
    }

    public function index()
    {
        $data['title'] = 'Admin';
        $data['heading'] = 'Welcome To Admin Panel';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;

        $this->load->view( 'inc/header', $data );
        $this->load->view( 'admin_view');
        $this->load->view( 'inc/footer' );
    }


    public function  getPosts()
    {
        $data['title'] = 'List Posts';
        $data['heading'] = 'Posts List View';
        $data['rows'] = $this->post_model->getListPosts();
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'admin_view');
        $this->load->view( 'list_view_posts', $data );
        $this->load->view( 'inc/footer' );
    }

    public function  getUsers()
    {
        $data['title'] = 'List Users';
        $data['heading'] = 'Users List View';
        $data['rows'] = $this->user_model->getListUsers();
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'admin_view');
        $this->load->view( 'list_view_users', $data );
        $this->load->view( 'inc/footer' );
    }

    public function  getComments()
    {
        $data['title'] = 'List Comments';
        $data['heading'] = 'Comments List View';
        $data['rows'] = $this->comment_model->getListComments();
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'admin_view');
        $this->load->view( 'list_view_comments', $data );
        $this->load->view( 'inc/footer' );
    }

    public function deleteUser()
    {
        $id = $this->uri->segment( 3 );
        $this->user_model->deleteUser( $id );
        redirect( 'admin/getUsers' );
    }

    public function deleteComment()
    {
        $id = $this->uri->segment( 3 );
        $this->comment_model->deleteComment( $id );
        redirect( 'admin/getComments' );
    }

}