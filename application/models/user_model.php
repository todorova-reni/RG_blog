<?php
/**
 * Created by PhpStorm.
 * User: Reni
 * Date: 24.11.2015 г.
 * Time: 15:44 ч.
 */
class User_model extends  CI_Model{

    public  function  getAll(){
        $q = $this->db->get('user');

        if($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function createUser($username, $password, $email,$verification_code){

        $data = array(
            'username' => $username,
            'password' => $password,
            'email'    => $email,
            'verification_code'    => $verification_code,
        );
        return $this->db->insert('user', $data);
    }

    public function verifyEmailAddress($verification_code){
        $this->db->set('activated', 1)
            ->where('verification_code', $verification_code)
            ->update('user');
        return $this->db->affected_rows();
    }

    public function  getByUsernameAndPass($username, $password){
        $this->db->select('username, password, activated');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        $row = $query->row();

        if($query->num_rows() ==1 && $row->activated){
            return true;
        }else{
            return false;
        }
    }
    public function authentication(){

        $username = $this->input->post('username');
        //$password = $this->input->post('password');
        $password = sha1($this->config->item('salt') . $this->input->post('password'));
        $remember = $this->input->post('remember');

        $sql = "SELECT * FROM user WHERE username = '{$username}' LIMIT 1";
        $result = $this->db->query($sql);
        $row = $result->row();
        if($result-> num_rows()===1){
            if($row->activated){
                if($row->password === $password){
                    $session_data = array(
                        'id'       => $row->id,
                        'username' => $row->username,
                        'email'    => $row->email
                    );
                    $this->set_session($session_data);
                    return 'logged_in';
                } else{
                     return 'incorrect_password';
                }
            }else{
                return 'not_activated';
            }
        }else{
            return 'user_not_found';
        }
    }

    public function set_session($session_data){
        $sess_data= array(
            'id'       => $session_data['id'],
            'username' => $session_data['username'],
            'email'    => $session_data['email'],
            'logged_in'=> 1
        );
        $this->session->set_userdata($sess_data);
    }
}