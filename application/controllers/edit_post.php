<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 17.11.2015 г.
 * Time: 14:50 ч.
 */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_Post extends  CI_Controller{

    private $logged_in;
    public  function  __construct(){
        parent::__construct();
        if($this->session->userdata('logged_in')){
            $this->logged_in = true;
        }else{
            $this->logged_in = false;
            redirect(site_url()."/login");
        }

       $this->load->model('post_model'); $this->ckeditor->basePath = base_url().'assets/js/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
            array( 'Source', '-', 'Bold', 'Italic', 'Underline','FontSize', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
        );
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '625px';
        $this->ckeditor->config['height'] = '300px';
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../assets/js/ckfinder/');
    }

    public function index($id=0){



        $data['title'] = 'New';
        $data['heading'] = 'New Post';
        $data['logged_in'] =$this->logged_in;
        if ((int)$id > 0){
            $data['post'] = $this->post_model->getById((int)$id);
        }
        $this->load->view('inc/header',$data);
        $this->load->view('edit_view',$data);
        //$this->load->view('edit_view');
        $this->load->view('inc/footer');
    }

    public function  getList(){
        $data['title'] = 'List';
        $data['heading'] = 'List View';
        $data['rows'] = $this->post_model->getAll();
        $data['logged_in'] =$this->logged_in;
        $this->load->view('inc/header',$data);
        $this->load->view('edit_list_view',$data);
        $this->load->view('inc/footer');
    }
    public function submission(){
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
        $this->form_validation->set_rules($FormRules);

        if($this->form_validation->run() === FALSE){
            $data=array(
                'title' => $_POST['title'],
                'body' => $_POST['body'],
                'author' => $_POST['author'],
                'date' => $_POST['date'],
            );
            $this->load->view('inc/header');
            $this->load->view('edit_view', $data);
            $this->load->view('inc/footer');
        }
        else{
            $this->load->view('inc/header');
            $this->load->view('form_success');
            $this->load->view('edit_view');
            $this->load->view('inc/footer');
            $this->create();
        }
    }

    public function create(){

        $id = (int)$this->input->post('id');
        $title = $this->input->post('title');
        $body = $this->input->post('body');
        $author = $this->input->post('author');
        $date = $this->input->post('date');
        $picture = $this->do_upload();

        $this->load->model('post_model');

        if ($id > 0){
            $this->post_model->updatePost($id, $title, $body, $author, $date, $picture );
        }else {
            $this->post_model->createPost( $title, $body, $author, $date, $picture );
        }
    }


    /*public function update(){
        $id =  $this->uri->segment(3);


        $this->load->view('inc/header');
        $this->load->view('edit_view', $data);
        $this->load->view('inc/footer');
    }*/
    public function delete(){

        $id = $this->uri->segment(3);
        $this->post_model->deletePost($id);

        redirect('edit_post/getList');
    }
    public function  do_upload(){

        $type = explode('.', $_FILES["pic"]["name"]);
        $type = $type[count($type) - 1];
        $pic_name = uniqid(rand()).'.'.$type;
        $path = APPPATH."../images/".$pic_name;

        if(in_array($type, array("jpg","jpeg","gif","png")))
            if(is_uploaded_file($_FILES["pic"]["tmp_name"])){
                if(move_uploaded_file($_FILES["pic"]["tmp_name"],$path))
                    return $pic_name;
        return "default.jpg";
        }
    $this->upload->do_upload($_FILES["pic"]["name"]);
    $this->resize($path,$pic_name);
    }

    public function resize($path, $pic_name){
        $config = array(
            'image_library' => 'gd2',
            'source_image'  => $path.$pic_name,
            'create_thumb'  => TRUE,
            'maintain_ratio'=> TRUE,
            'width'         => 250,
            'height'        => 250,
            'new_image'     =>$path.'thumb_'.$pic_name
        );
        $this->load->library('image_lib', $config);
        $this->image_lib->resize();
    }

}