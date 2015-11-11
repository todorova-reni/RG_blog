<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 11.11.2015 г.
 * Time: 16:19 ч.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_Email extends CI_Migration{

    public function add(){
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '30'
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '10'
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '30'
            ),
            'message' => array(
                'type' => 'TEXT',
            )
        ));

        $this->dbforge->create_table('email');
    }
}