<?php

/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 24.11.2015 г.
 * Time: 15:44 ч.
 */
class User_model extends CI_Model
{

    public function  getListUsers()
    {
        $this->db->order_by( 'id', 'DESC' );
        $q = $this->db->get( 'user' );

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createUser( $username, $password, $email, $verification_code )
    {
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'verification_code' => $verification_code,
        );
        return $this->db->insert( 'user', $data );
    }

    public function verifyEmailAddress( $verification_code )
    {
        $this->db->set( 'activated', 1 )
            ->where( 'verification_code', $verification_code )
            ->update( 'user' );
        return $this->db->affected_rows();
    }

    public function  authentication( $username, $password )
    {
        $this->db->select( 'username, password, activated' );
        $this->db->from( 'user' );
        $this->db->where( 'username', $username );
        $this->db->where( 'password', $password );
        $query = $this->db->get();
        $row = $query->row();

        if ($query->num_rows() == 1 && $row->activated) {
            return true;
        } else {
            return false;
        }
    }

    public function checkAdmin( $username )
    {
        $this->db->select( 'username, activated, is_admin' );
        $this->db->from( 'user' );
        $this->db->where( 'username', $username );
        $query = $this->db->get();
        $row = $query->row();

        if ($query->num_rows() == 1 && $row->activated && $row->is_admin) {
            return true;
        } else {
            return false;
        }
    }

    public function  deleteUser( $id )
    {
        $this->db->where( 'id', $id );
        return $this->db->delete( 'user' );
    }

}