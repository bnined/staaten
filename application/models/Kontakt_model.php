<?php

class Kontakt_model extends CI_model {

  public function __construct()
        {
                $this->load->database();
        }

  public function get_kontakttext() {
    $query = $this->db->get('kontaktformular');
    foreach($query->result() as $erg) {
      if($erg->id == 'kontakttext') {
        if($this->session->lang == "de") {
          $kontakt = $erg->text;
        } elseif($this->session->lang == "en") {
          $kontakt = $erg->text_en;
        }
      }

    }

    return $kontakt;
  }

public function change_kontakttext($kontakttext) {
  if($this->session->lang == "de") {
    $this->db->set('text', $kontakttext);
  } elseif($this->session->lang == "en") {
    $this->db->set('text_en', $kontakttext);
  }
  $this->db->where('id', 'kontakttext');
  $this->db->update('kontaktformular');

  }

}
?>
