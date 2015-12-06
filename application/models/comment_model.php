<?php

/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 30.11.2015 г.
 * Time: 19:42 ч.
 */
class Comment_model extends CI_Model
{

    public function  getListComments()
    {
        $this->db->select( 'comment.id AS number, comment.body AS comment, comment.id_post, comment.author, comment.date, post.id' );
        $this->db->from( 'comment' );
        $this->db->join( 'post', 'comment.id_post = post.id' );
        $this->db->order_by( 'comment.id', 'DESC' );
        $q = $this->db->get();

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getByIdPost( $id )
    {
        $this->db->select( 'comment.id, comment.body, comment.date, comment.author, comment.id_post, post.id,' );
        $this->db->from( 'comment' );
        $this->db->join( 'post', 'comment.id_post = post.id' );
        $this->db->where( 'id_post', $id );
        $this->db->order_by( 'comment.date', 'DESC' );
        $query = $this->db->get();

        return $query->result();
    }

    public function createComment( $body, $id_post, $author )
    {
        $data = array(
            'body' => $body,
            'id_post' => $id_post,
            'author' => $author,
        );
        return $this->db->insert( 'comment', $data );
    }

    public function  deleteComment( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'comment' );
    }

}