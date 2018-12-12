<?php
class Staaten_model extends CI_Model {

  public function __construct() {
                $this->load->database();
        }

  public function get_staatenliste() {
    if($this->session->lang == "de") {
      $this->db->order_by('shs_ahs DESC, land_lang ASC');
    } elseif ($this->session->lang == "en") {
      $this->db->order_by('shs_ahs DESC, land_lang_en ASC');
    }

    $query = $this->db->get('staaten');

    $laender = array();
    foreach($query->result() as $erg) {
      $land = $erg->land_lang;
      $id = $erg->id;
      $laender[$id] = $land;
    }

    return $laender;
  }

  public function get_staatenliste_shs() {
    if($this->session->lang == "de") {
      $this->db->order_by('land_lang ASC');
    } elseif ($this->session->lang == "en") {
      $this->db->order_by('land_lang_en ASC');
    }

    $this->db->where('shs_ahs', 'shs');
    $query = $this->db->get('staaten');

    $laender_shs = array();
    foreach($query->result() as $erg) {
      $land = $erg->land_lang;
      $id = $erg->id;
      $laender_shs[$id] = $land;
    }


    return $laender_shs;
  }

  public function get_staat($id) {
    $this->db->where('id', $id);
    $query = $this->db->get('staaten');
    $row = $query->row();
    return $row;
  }


  public function add_staat($id, $landl, $landlen, $landn, $landnen, $shs) {
      $data = array(
        'id' => $id,
        'land_lang' => $landl,
        'land_lang_en' => $landlen,
        'land_navi' => $landn,
        'land_navi_en' => $landnen,
        'shs_ahs' => $shs
      );
      $this->db->insert('staaten', $data);
      }


  public function change_staat($id, $kuerzel, $landl, $landlen, $landn, $landnen, $shs) { 
      $data = array(
        'id' => $kuerzel,
        'land_lang' => $landl,
        'land_lang_en' => $landlen,
        'land_navi' => $landn,
        'land_navi_en' => $landnen,
        'shs_ahs' => $shs
        );

      $this->db->where('id', $id);
      $this->db->set($data);
      $this->db->update('staaten');
    }

  public function delete_staat($id) {
    $this->db->where('id', $id);
    $this->db->delete('staaten');
  }

}

?>
