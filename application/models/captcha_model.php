<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 12.11.2015 г.
 * Time: 15:16 ч.
 */
class Captcha_model extends  CI_Model{

    function generateCaptcha(){
        $abc = array('1','2','3',
            '4','5','6',
            '7','8','9',
            '0','A','B',
            'C','D','E',
            'F','G','H',
            'I','J','K',
            'L','M','N',
            'O','P','Q',
            'R','S','T',
            'U','V','W',
            'X','Y','Z',
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
        );

        /*  $expire = $captcha['time'] + $captcha['expiration'];


     /* $this ->db ->where('time < ', $expire);
         $this->db->delete('captcha');*/

        /* $value = array(
           'time'      => $captcha['time'],
           'ip_address'=> $this->input->ip_address(),
           'word'      => $captcha['word']
       );

      /* $->db->insert('captcha', $value);
       $img = create_captcha($captcha);
      return $data['image'] = $img['image'];*/
        $img = create_captcha($captcha);

       return $img;
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