<?php

class Admin_model extends CI_Model {

  public function __construct()
        {
                $this->load->database();
        }

  // Read data using username and password
  public function login($data) {
    /*$benutzername = $data['benutzername'];
    $benutzername = $this->db->escape($benutzername);
    $condition = array('name' => $benutzername); */  // warum funktioniert das nicht?
    $condition = array('name' => $data['benutzername']/*, 'passwort' => $data['password']*/);
    $this->db->select('*');
    $this->db->from('admin');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    $pw = $query->row()->passwort;

    if ($query->num_rows() == 1 && password_verify($data['password'], $pw)) {
      return true;
    } else {
      return false;
    }

  }

  // Read data from database to show data in admin page
  public function read_user_information($username) {

    $condition = "name =" . "'" . $username . "'";
    $this->db->select('*');
    $this->db->from('admin');
    $this->db->where($condition);
    $this->db->limit(1);
    $query = $this->db->get();

    if ($query->num_rows() == 1) {
      return $query->result();
    } else {
      return false;
    }
  }

}

 ?>
