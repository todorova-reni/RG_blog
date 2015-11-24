<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 17.11.2015 г.
 * Time: 15:07 ч.
 */
class Post_model extends  CI_Model{

    public  function  getAll(){
        $q = $this->db->get('post');

        if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createPost($title, $body, $author, $date, $picture){

        $data = array(
            'title'   => $title,
            'body'    => $body,
            'author'  => $author,
            'date'    => $date,
            'picture' => $picture
        );
        return $this->db->insert('post', $data);
    }

    public function getById($id){
        $query = $this->db->get_where('post', array('id' => $id));
        return $query->row();
    }

    public function  updatePost($id,$title, $body, $author, $date, $picture){

        $data = array(
            'title'   => $title,
            'body'    => $body,
            'author'  => $author,
            'date'    => $date,
            'picture' => $picture
        );
        $this->db->where('id',$id);
        return $this->db->update('post',$data);
    }

    public function  deletePost($id){
        $this->db->where('id',$id);
        return $this->db->delete('post');
    }

}