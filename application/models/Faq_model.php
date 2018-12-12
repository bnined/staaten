<?php
/* Model für den Zugriff auf die Tabelle "faq_dt" (oder die Tabellen faq_dt und faq_en) */

class Faq_model extends CI_Model {

  public function __construct()
        {
                $this->load->database();
        }

  public function get_faq_teaser() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    foreach($query->result() as $erg) {
      for($nr = 1; $nr <= 5; $nr++) {
        if($erg->selected_als == 'nr'.$nr) {
          $faq[$nr] = $erg->frage_kurz;
        }
      }

    }
    return $faq;
  }

  public function get_faq_teaser_select() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    foreach($query->result() as $erg) {
      $faq[] = $erg->frage_kurz;
      }
    return $faq;
  }

  public function get_faq_teaser_select_2() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    foreach($query->result() as $erg) {
      $id = $erg->id;
      $faq[$id] = $erg->frage_kurz;
      }
    return $faq;
  }

  public function get_faq_teaser_selected() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    foreach($query->result() as $erg) {
      $id = $erg->id;
      $selected[$id] = $erg->selected_als;
      }
    return $selected;
  }



  function get_faq_einleitung() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    foreach($query->result() as $erg) {
      if($erg->id == 'einleitung') {
      $faq_einleitung = $erg->frage_antwort_lang;

      /* Stringmanipulation für Summary / Details*/
      /*$pos = strpos($faq_einleitung, "<p>");
      $laenge = strlen($faq_einleitung);
      $add = substr($faq_einleitung, 0, $pos) . "</summary>" . substr($faq_einleitung, $pos, $laenge);
      $faq_einleitung = "<details><summary>" . $add . "</details>";*/
      }
    }
    return $faq_einleitung;
  }


  function get_faq_fragen() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
      $zeilen = $this->db->count_all('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
      $zeilen = $this->db->count_all('faq_en');
    }

    foreach($query->result() as $erg) {
      for ($nr = 1; $nr <= $zeilen; $nr++) {
      if($erg->id == 'faq'.$nr) {
        /* Stringmanipulation für Summary / Details */
        $faq_frage[$nr]= $erg->frage_antwort_lang;
        $pos = strpos($faq_frage[$nr], "<p>");
        $laenge = strlen($faq_frage[$nr]);
        $add = substr($faq_frage[$nr], 0, $pos) . "</summary>" . substr($faq_frage[$nr], $pos, $laenge);
        $faq_frage[$nr] = "<details><summary>" . $add . "</details>";
      }
    }
    }
    return $faq_frage;
  }

  function get_faq_fragen_edit() {
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
      $zeilen = $this->db->count_all('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
      $zeilen = $this->db->count_all('faq_en');
    }

    foreach($query->result() as $erg) {
      for ($nr = 1; $nr <= $zeilen; $nr++) {
      if($erg->id == 'faq'.$nr) {
        /* Stringmanipulation für Summary / Details */
        $faq_frage[$nr]= $erg->frage_antwort_lang;
      }
    }
    }
    return $faq_frage;
  }

  public function change_faq($faqtext, $faqnr) {
    $data = array(
            'frage_antwort_lang' => $faqtext
            );
    $this->db->where('id', $faqnr);

    if($this->session->lang == "de") {
      $this->db->update('faq_dt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('faq_en', $data);
    }
  }

  public function clear_faqteaser_liste() {
    $this->db->set('selected_als', null);
    if($this->session->lang == "de") {
      $this->db->update('faq_dt');
    } elseif($this->session->lang == "en") {
      $this->db->update('faq_en');
    }
  }

  public function change_faqteaser_liste($nr, $id) {

    $data = array(
            'selected_als' => 'nr'.$nr
            );

    $this->db->where('id', $id);

    if($this->session->lang == "de") {
      $this->db->update('faq_dt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->update('faq_en', $data);
    }
  }

  public function get_ids() {
    $this->db->like('id', 'faq', 'after');
    if($this->session->lang == "de") {
      $query = $this->db->get('faq_dt');
    } elseif($this->session->lang == "en") {
      $query = $this->db->get('faq_en');
    }

    $ids = array();

    foreach ($query->result_array() as $row) {
      $nr = $row['id'];
      $nr = (substr($nr, 3));
      $ids[] = $nr;
    }

    $id = max($ids) + 1;

    return $id;

  }

  public function add_faq($faqlang, $faqkurz) {
    $id = $this->get_ids();
    $id = 'faq'.$id;

    $data = array(
        'id' => $id,
        'frage_antwort_lang' => $faqlang,
        'frage_kurz' => $faqkurz
    );

    if($this->session->lang == "de") {
      $this->db->insert('faq_dt', $data);
    } elseif($this->session->lang == "en") {
      $this->db->insert('faq_en', $data);
    }

  }

  public function delete_faq($id) {
    $this->db->where('id', $id);
    if($this->session->lang == "de") {
      $this->db->delete('faq_dt');
    } elseif($this->session->lang == "en") {
      $this->db->delete('faq_en');
    }

  }

}
 ?>
