<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 17.11.2015 г.
 * Time: 14:50 ч.
 */
if (!defined( 'BASEPATH' )) exit( 'No direct script access allowed' );

class Edit_Post extends CI_Controller
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
            redirect( site_url() . "login" );
        }
        if ($this->session->userdata( 'is_admin' )) {
            $this->is_admin = true;
        } else {
            $this->is_admin = false;
        }

        $this->load->model( 'post_model' );
        $this->ckeditor->basePath = base_url() . 'assets/js/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
            array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'FontSize', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo', '-', 'NumberedList', 'BulletedList' )
        );
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '625px';
        $this->ckeditor->config['height'] = '300px';
        $this->ckfinder->SetupCKEditor( $this->ckeditor, '../../assets/js/ckfinder/' );
    }

    public function index( $id = 0 )
    {
        $data['title'] = 'New';
        $data['heading'] = 'New Post';
        $data['logged_in'] = $this->logged_in;
        $data['is_admin'] = $this->is_admin;
        if ((int)$id > 0) {
            $data['post'] = $this->post_model->getById( (int)$id );
        }
        $this->load->view( 'inc/header', $data );
        $this->load->view( 'edit_view', $data );
        $this->load->view( 'inc/footer' );
    }

    public function submission()
    {
        $FormRules = array(
            array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[3]|max_length[255]'
            ),
            array(
                'field' => 'body',
                'label' => 'Body',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[3]'
            ),
            array(
                'field' => 'author',
                'label' => 'Author',
                'rules' => 'trim|strip_tags|xss_clean|required|min_length[3]|max_length[30]'
            ),
            array(
                'field' => 'date',
                'label' => 'Date',
                'rules' => 'trim|strip_tags|xss_clean|required'
            )
        );
        $this->form_validation->set_rules( $FormRules );

        if ($this->form_validation->run() === FALSE) {
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->load->view( 'inc/header', $data );
            $this->load->view( 'edit_view' );
            $this->load->view( 'inc/footer' );
        } else {
            $data['logged_in'] = $this->logged_in;
            $data['is_admin'] = $this->is_admin;
            $this->load->view( 'inc/header', $data );
            $this->load->view( 'edit_view' );
            $this->load->view( 'inc/footer' );
            $this->create();
        }
    }

    public function create()
    {
        $id = (int)$this->input->post( 'id' );
        $title = $this->input->post( 'title' );
        $body = $this->input->post( 'body' );
        $author = $this->input->post( 'author' );
        $date = $this->input->post( 'date' );
        $picture = $this->do_upload();

        $this->load->model( 'post_model' );

        if ($id > 0) {
            $this->session->set_flashdata( 'success_post_update', 'Your article was updatedS successfully!' );
            $this->post_model->updatePost( $id, $title, $body, $author, $date, $picture );
            redirect( site_url() . "admin" );
        } else {
            $this->session->set_flashdata( 'success_post_add', 'Your article was posted successfully!' );
            $this->post_model->createPost( $title, $body, $author, $date, $picture );
            redirect( site_url() . "edit_post" );
        }
    }

    public function  do_upload()
    {
        if (UPLOAD_ERR_NO_FILE == $_FILES['pic']['error']) {
            return null;
        }

        $type = explode( '.', $_FILES["pic"]["name"] );
        $type = $type[count( $type ) - 1];
        $pic_name = uniqid( rand() ) . '.' . $type;
        $path = APPPATH . "../images/" . $pic_name;

        if (in_array( $type, array( "jpg", "jpeg", "gif", "png" ) ))
            if (is_uploaded_file( $_FILES["pic"]["tmp_name"] )) {
                if (move_uploaded_file( $_FILES["pic"]["tmp_name"], $path ))
                    return $pic_name;
                return "default.jpg";
            }
        $this->upload->do_upload( $_FILES["pic"]["name"] );
        $this->resize( $path, $pic_name );
    }

    public function resize( $path, $pic_name )
    {
        $config = array(
            'image_library' => 'gd2',
            'source_image' => $path . $pic_name,
            'create_thumb' => TRUE,
            'maintain_ratio' => TRUE,
            'width' => 250,
            'height' => 250,
            'new_image' => $path . 'thumb_' . $pic_name
        );
        $this->load->library( 'image_lib', $config );
        $this->image_lib->resize();
    }

    public function delete()
    {
        $id = $this->uri->segment( 3 );
        $this->post_model->deletePost( $id );

        redirect( 'admin/getPosts' );
    }
}