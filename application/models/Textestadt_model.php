<?php

/* Model für den Zugriff auf die Tabelle "textestadt" */

class Textestadt_model extends CI_Model {

  public function __construct()
        {
                $this->load->database();
        }

/* ====================== Teaser für Startseite ========================== */
  public function get_konzept_teaser() {
    if($this->session->lang == "de") {
      $query = $this->db->get_where('textestadt', array('id' => 'konzept'));
    } elseif($this->session->lang == "en") {
      $query = $this->db->get_where('textestadt_en', array('id' => 'konzept'));
    }

    foreach($query->result() as $erg) {
        $konzeptteaser = $erg->teaser;
    }
    return $konzeptteaser;
  }

  public function get_staaten_teaser() {
    if($this->session->lang == "de") {
      $query = $this->db->get_where('textestadt', array('id' => 'staaten'));
    } elseif($this->session->lang == "en") {
      $query = $this->db->get_where('textestadt_en', array('id' => 'staaten'));
    }

    foreach($query->result() as $erg) {
        $staatenteaser = $erg->teaser;
    }
    return $staatenteaser;
  }

  public function get_kritik_teaser() {
    if($this->session->lang == "de") {
      $query = $this->db->get_where('textestadt', array('id' => 'kritik'));
    } elseif($this->session->lang == "en") {
      $query = $this->db->get_where('textestadt_en', array('id' => 'kritik'));
    }

    foreach($query->result() as $erg) {
        $kritikteaser = $erg->teaser;
    }
    return $kritikteaser;
  }

  public function change_teaser($teasertext, $teaserid) {
    $data = array(
            'teaser' => $teasertext
    );
    $this->db->where('id', $teaserid);

    if($this->session->lang == "de") {
      $this->db->update('textestadt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('textstadt_en', $data);
    }
  }


/* ================= Konzeptseite ================= */

  public function get_konzept($konzept) {
    if($this->session->lang == "de") {
      $query = $this->db->get('textestadt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('textestadt_en');
    }

    foreach($query->result() as $erg) {
      if($erg->id == $konzept) {
        $konzepttext = $erg->volltext;
      }
    }
    return $konzepttext;
  }


  public function change_konzept($konzepttext, $konzeptid) {
    $data = array(
            'volltext' => $konzepttext
    );
    $this->db->where('id', $konzeptid);

    if($this->session->lang == "de") {
      $this->db->update('textestadt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('textstadt_en', $data);
    }
  }


/* ================= Staatenseite ================= */

public function get_staateninfo($staatenid) {
  if($staatenid == "") {
    return "";
  }
  if($this->session->lang == "de") {
    $query = $this->db->get_where('textestadt', array('id' => $staatenid));
  } elseif($this->session->lang == "en") {
    $query = $this->db->get_where('textestadt_en', array('id' => $staatenid));
  }

  $erg = $query->row();
  $staateninfo = $erg->volltext;
  return $staateninfo;

}

public function change_staateninfo($staatenid, $text) { /* ändert Infos aus textestadt Tabelle - Einleitungstext */

  $this->db->where('id', $staatenid);
  $data = array(
      'id' => $staatenid,
      'volltext' => $text
    );

  if($this->session->lang == "de") {
      $this->db->update('textestadt', $data);
  } elseif($this->session->lang == "en") {
      $this->db->update('textestadt_en', $data);
    }
}


public function get_staateninfo_array($staatenid) {
  if($staatenid == "") {
    return array();
  }

  $this->db->where('tag', $staatenid);
  if($this->session->lang == "de") {
    $this->db->from('textestadt');
  } elseif($this->session->lang == "en") {
    $this->db->from('textestadt_en');
  }

  $query = $this->db->get();
  $i=0;
  foreach($query->result_array() as $row) {
    $staateninfo[$i] = $row['volltext'];
    $i++;
  }
  return $staateninfo;

}

public function add_staaten($text1, $text2, $text3, $text4, $tag) {
  $data = array(
    array(
      'id' => $tag."1",
      'volltext' => $text1,
      'tag' => $tag
    ),
    array(
      'id' => $tag."2",
      'volltext' => $text2,
      'tag' => $tag
    ),
    array(
      'id' => $tag."3",
      'volltext' => $text3,
      'tag' => $tag
    ),
    array(
      'id' => $tag."4",
      'volltext' => $text4,
      'tag' => $tag
    )
  );
  if($this->session->lang == "de") {
    $this->db->insert_batch('textestadt', $data);
  } elseif($this->session->lang == "en") {
    $this->db->insert_batch('textestadt_en', $data);
  }

}

public function change_staaten($text1, $text2, $text3, $text4, $tag_alt, $tag_neu) { /* ändert Infos aus textestadt Tabelle */

$data = array(
    array(
      'id' => $tag_alt."1",
      'id' => $tag_neu."1",
      'volltext' => $text1
    ),
    array(
      'id' => $tag_alt."2",
      'id' => $tag_neu."2",
      'volltext' => $text2
    ),
    array(
      'id' => $tag_alt."3",
      'volltext' => $text3,
      'id' => $tag_neu."3"
    ),
    array(
      'id' => $tag_alt."4",
      'id' => $tag_neu."4",
      'volltext' => $text4,
    )
  );

  $this->db->set($data);
  if($this->session->lang == "de") {
    $this->db->set_update_batch('textestadt', $data);
  } elseif($this->session->lang == "en") {
    $this->db->update('textestadt_en', $data);
  }
}



/* ================= Kritikseite ================= */

  public function get_kritik($kritik) {
    if($this->session->lang == "de") {
      $query = $this->db->get('textestadt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('textestadt_en');
    }

    foreach($query->result() as $erg) {
      if($erg->id == $kritik) {
        $kritiktext = $erg->volltext;
      }
    }
    return $kritiktext;
  }


  public function change_kritik($kritiktext, $kritikid) {
      $data = array(
              'volltext' => $kritiktext
      );
      $this->db->where('id', $kritikid);

      if($this->session->lang == "de") {
        $this->db->update('textestadt', $data);
      } elseif($this->session->lang == "en") {
        $this->db->update('textstadt_en', $data);
      }
    }

/* ================= Datenschutz ================= */
  public function get_datenschutz() {
    if($this->session->lang == "de") {
      $query = $this->db->get('textestadt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('textestadt_en');
    }

    foreach($query->result() as $erg) {
      if($erg->id == 'datenschutz') {
        $datenschutztext = $erg->volltext;
      }
    }
    return $datenschutztext;
  }

  public function change_datenschutz($datenschutz) {
    $data = array(
            'volltext' => $datenschutz
            );
    $this->db->where('id', 'datenschutz');

    if($this->session->lang == "de") {
      $this->db->update('textestadt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('textstadt_en', $data);
    }
  }

/* ================= Impressum ================= */

  public function get_impressum() {
    if($this->session->lang == "de") {
      $query = $this->db->get('textestadt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('textestadt_en');
    }

    foreach($query->result() as $erg) {
      if($erg->id == 'impressum') {
        $impressumtext = $erg->volltext;
      }
    }
    return $impressumtext;
  }

  public function change_impressum($impressum) {
    $data = array(
            'volltext' => $impressum
            );
    $this->db->where('id', 'impressum');

    if($this->session->lang == "de") {
      $this->db->update('textestadt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('textstadt_en', $data);
    }
  }

/* ================= Kontakt ================= */

/* ================= Sitemap ================= */


}


 ?>
