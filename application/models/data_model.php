<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 11.11.2015 г.
 * Time: 15:07 ч.
 */
class Data_model extends  CI_Model{

    public function getAll(){

        $q = $this->db->get('email');

        if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createRecord($name, $phone, $email, $message){
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message
        );
       return $this->db->insert('email', $data);
    }

   /*public function addTable(){
        $this->load->dbforge();

        $fields = array(
            'id' => array(
                        'type' => 'INT',
                        'constraint' => 10,
                        'unsigned' => true,
                        'auto_increment' => true
                    ),
            'name' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 30
                    ),
            'phone' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 10
                    ),
            'email' => array(
                        'type' => 'VARCHAR',
                        'constraint' => 30
                    ),
            'message' => array(
                        'type' => 'TEXT'
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('email');
    }*/
}