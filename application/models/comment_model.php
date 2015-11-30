<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 30.11.2015 г.
 * Time: 19:42 ч.
 */
class Comment_model extends  CI_Model
{

    public function  getAll()
    {
        $q = $this->db->get( 'comment' );

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createComment($body, $id_post, $id_user){

        $data = array(
            'body'     => $body,
            'id_post'  => $id_post,
            'id_author'=> $id_user,
        );
        return $this->db->insert('comment', $data);
    }

    public function getByIdPost($id){
        $query = $this->db->get_where('comment', array('id_post' => $id));
        return $query->row();
    }

    public function  deletePost($id){
        $this->db->where('id',$id);
        return $this->db->delete('comment');
    }

}