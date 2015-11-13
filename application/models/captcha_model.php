<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 12.11.2015 г.
 * Time: 15:16 ч.
 */
class Captcha_model extends  CI_Model{

    function createCaptcha(){
        $abc = array('1','2','3',
            '4','5','6',
            '7','8','9',
            '0','a','b',
            'c','d','e',
            'f','g','h',
            'i','j','k',
            'l','m','n',
            'o','p','q',
            'r','s','t',
            'u','v','w',
            'x','y','z',
            '!','$','%'
        );
        $word = '';
        $n=0;

        While ($n < 5){
            $word .=$abc[mt_rand(0,35)];
            $n++;
        }
        $captcha = array(
            'word'       => $word,
            'img_path'   => './captcha/',
            'img_url'  => base_url().'captcha/',
            'font_path'  => './fonts/OpenSans-Bold.ttf',
            'img_width'  => '150',
            'img_height' => '50',
            'expiration' => '300',
            'time'       => time()
        );

        $expire = $captcha['time'] + $captcha['expiration'];

        $this ->db ->where('time < ', $expire);
        $this->db->delete('captcha');

        $value = array(
            'time'      => $captcha['time'],
            'ip_address'=> $this->input->ip_address(),
            'word'      => $captcha['word']
        );

        $this->db->insert('captcha', $value);

        $img = create_captcha($captcha);

       return $data['image'] = $img['image'];
    }

    /*public function addTable(){
        $this->load->dbforge;

        $fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
                'auto_increment' => true
            ),
            'time' => array(
                'type' => 'INT',
                'constraint' => 10,
                'unsigned' => true,
            ),
            'ip_address' => array(
                'type' => 'VARCHAR',
                'constraint' => 161
            ),
            'word' => array(
                'type' => 'VARCHAR',
                'constraint' => 10
            )
        );

        $this->dbforge->add_field($fields);
        $this->dbforge->add_key('id', true);
        $this->dbforge->create_table('captcha');
    }*/

}