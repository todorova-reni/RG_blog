<?php

/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 17.11.2015 г.
 * Time: 15:07 ч.
 */
class Post_model extends CI_Model
{
    public function  getListPosts()
    {
        $q = $this->db->get( 'post' );

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }


    public function getAll( $id )
    {
        $query = $this->db->get( 'post' );
        $total = $query->num_rows();

        $config['base_url'] = 'http://localhost/Blog/RG_blog/index.php/blog/index';
        $config['total_rows'] = $total;
        $config['per_page'] = 5;
        $config['num_links'] = 10;
        $this->pagination->initialize( $config );

        $result = $this->db->get( 'post', $config['per_page'], $id );
        return $result;
    }

    public function createPost( $title, $body, $author, $date, $picture )
    {
        $data = array(
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'date' => $date,
            'picture' => $picture
        );
        return $this->db->insert( 'post', $data );
    }

    public function getById( $id )
    {
        $query = $this->db->get_where( 'post', array( 'id' => $id ) );
        return $query->row();
    }

    public function getPostId($id){
        $this->db->select('*');
        $this->db->from('post');
        $this->db->where('id', $id);
        $row = $this->db->get();
        return $row;
    }

    public function  updatePost( $id, $title, $body, $author, $date, $picture )
    {
        $data = array(
            'title' => $title,
            'body' => $body,
            'author' => $author,
            'date' => $date,
            'picture' => $picture
        );
        $this->db->where( 'id', $id );
        return $this->db->update( 'post', $data );
    }

    public function  deletePost( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'post' );
    }

    public function increaseView( $id )
    {
        $this->db->where( 'id', $id );
        $this->db->set( 'views', 'views+1', FALSE );
        $this->db->update( 'post' );
    }
}