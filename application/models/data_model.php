<?php

/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 11.11.2015 г.
 * Time: 15:07 ч.
 */
class Data_model extends CI_Model
{

    public function getAll()
    {
        $q = $this->db->get( 'email' );

        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createRecord( $name, $phone, $email, $message )
    {
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message
        );
        return $this->db->insert( 'email', $data );
    }
}