<?php

class Bilder_model extends CI_Model {

  public function __construct()
        {
                $this->load->database();
        }

  public function get_img_tags($bildname) {
    $query = $this->db->get('bilder');

    foreach($query->result() as $erg) {
      if($erg->id == $bildname) {
        if($this->session->lang == "de") {
          $title = $erg->title_dt;
          $alt = $erg->alt_dt;
        } elseif($this->session->lang == "en") {
          $title = $erg->title_en;
          $alt = $erg->alt_en;
        }
        $tags = 'src="'.base_url('uploads/').$bildname.'.jpg" title="'.$title.'" alt="'.$alt.'"';
        return $tags;
      }
    }
  }

  public function set_img_tags($bildname, $title_dt, $alt_dt, $title_en, $alt_en) {  /* kombiniert set und add, je nach dem, ob Datensatz vorhanden */
    $this->db->where('id', $bildname);
    $query = $this->db->get('bilder');

    if($query->result()) {
      $data = array(
            'title_dt' => $title_dt,
            'alt_dt' => $alt_dt,
            'title_en' => $title_en,
            'alt_en' => $alt_en
      );
      $this->db->where('id', $bildname);
      $this->db->update('bilder', $data);
    } else {
      $data = array(
            'id' => $bildname,
            'title_dt' => $title_dt,
            'alt_dt' => $alt_dt,
            'title_en' => $title_en,
            'alt_en' => $alt_en
      );
      $this->db->insert('bilder', $data);
    }


  }

  /*public function add_img_tags($bildname, $title_dt, $alt_dt, $title_en, $alt_en) {
    $data = array(
          'id' => $bildname,
          'title_dt' => $title_dt,
          'alt_dt' => $alt_dt,
          'title_en' => $title_en,
          'alt_en' => $alt_en
    );
    $this->db->insert('bilder', $data);
  }


  public function set_img_tags($bildname, $title_dt, $alt_dt, $title_en, $alt_en) {
    $data = array(
          'title_dt' => $title_dt,
          'alt_dt' => $alt_dt,
          'title_en' => $title_en,
          'alt_en' => $alt_en
    );
    $this->db->where('id', $bildname);
    $this->db->update('bilder', $data);
  }*/

  public function delete_img_tags($bildname) {
    $this->db->where('id', $bildname);
    $this->db->delete('bilder');
  }

}

?>
