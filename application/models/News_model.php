<?php
/* Model für den Zugriff auf die Tabelle "news"  */

class News_model extends CI_Model {

  public function __construct()
        {
                $this->load->database();
        }

  public function get_news_teaser() {
    $this->db->order_by('datum DESC, id DESC');
    $this->db->limit(3);
    $query = $this->db->get('news');

    foreach($query->result() as $erg) {
      $date = new DateTime($erg->datum);
      $link = $erg->link;
      if($this->session->lang == "de") {
        $text = $erg->text;
      } elseif($this->session->lang == "en") {
        $text = $erg->text_en;
      }
      $newsteaser[] = "<article>" . $date->format('d.m.Y') . $text . $link . "</article>";
      }
      return $newsteaser;
    }

    public function count_news() {
      $this->db->count_all('news');
    }

    public function get_news_full($limit, $start) {
      $this->db->order_by('datum DESC, id DESC');
      $this->db->limit($limit, $start);
      $query = $this->db->get('news');

      if ($query->num_rows() > 0) {
          foreach($query->result() as $erg) {
            $date = new DateTime($erg->datum);
            $link = $erg->link;
            $id = $erg->id;
            if($this->session->lang == "de") {
              $text = $erg->text;
            } elseif($this->session->lang == "en") {
              $text = $erg->text_en;
            }
            $newsfull[$id] = "<article>" . $date->format('d.m.Y') . $text . ": " . $link . "</article>";
            }
            return $newsfull;
      }
      return false;

      }


  public function add_news($datum, $text, $slug, $text_en, $slug_en, $link, $origin) {
    $data = array(
          'datum' => $datum,
          'text' => '<p>'.$text.'</p>',
          'slug' => $slug,
          'text_en' => '<p>'.$text_en.'</p>',
          'slug_en' => $slug_en,
          'link' => '<a href="'.$link.'">'.$origin.'</a>',
          'origin' => $origin
    );
    $this->db->insert('news', $data);
  }

  public function delete_news($id) {
    $this->db->where('id', $id);
    $this->db->delete('news');
  }


}

 ?>
