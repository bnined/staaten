<?php
class Staaten extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('user_agent');
    $this->load->model(array('textestadt_model', 'staaten_model', 'bilder_model'));

    if($this->input->get("de")) {
      $this->session->lang = "de";
    } elseif($this->input->get("en")) {
      $this->session->lang = "en";
    }
  }


  public function index() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    if($this->input->post('land')) {
      $data['laenderinfo'] = null;
    } else {
      $data['laenderinfo'] = $this->textestadt_model->get_staateninfo("staaten");
    }

    $data['laenderliste'] = $this->staaten_model->get_staatenliste();

    $data['laenderliste_shs'] = $this->staaten_model->get_staatenliste_shs();
    $data['landinfo'] = $this->textestadt_model->get_staateninfo_array($this->input->post('land'));

    $data['staatenbild'] = $this->bilder_model->get_img_tags($this->input->post('land'));
    $this->load->view('pages/staaten/staaten', $data);
    $this->load->view('templates/footer');
  }


  public function edit() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    if($this->input->post('land')) {
      $data['laenderinfo'] = null;
    } else {
      $data['laenderinfo'] = $this->textestadt_model->get_staateninfo("staaten");
    }
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $data['landinfo'] = $this->textestadt_model->get_staateninfo_array($this->input->post('land'));
    $upload['bild'] = $this->input->post('land');
    $upload['base'] = 'staaten';
    $upload['error'] = ' ';
    $data['bildupload'] = $this->load->view('uploads/upload_form', $upload, TRUE);
    $data['staatenbild'] = $this->bilder_model->get_img_tags($this->input->post('land'));
    $data['staat'] = $this->staaten_model->get_staat($this->input->post('land'));

    if($this->session->userdata('logged_in')) {

        if($this->input->post('einl_aendern')) {
          $this->textestadt_model->change_staateninfo('staaten', $this->input->post('einleitung'));
        }

        $data['laenderinfo'] = $this->textestadt_model->get_staateninfo("staaten");

        if($this->input->post('landinfo_aend')) {
            $this->staaten_model->change_staat(
                                              $this->input->post('kuerzel_alt'),
                                              $this->input->post('kuerzel'),
                                              $this->input->post('land_lang'),
                                              $this->input->post('land_lang_en'),
                                              $this->input->post('land_navi'),
                                              $this->input->post('land_navi_en'),
                                              $this->input->post('shs_ahs')
                                            );
            $this->textestadt_model->change_staaten(
                                              $this->input->post('absatz1'),
                                              $this->input->post('absatz2'),
                                              $this->input->post('absatz3'),
                                              $this->input->post('absatz4'),
                                              $this->input->post('kuerzel_alt'),
                                              $this->input->post('kuerzel')
                                            );

             $pos = strrpos($this->agent->referrer(), "/");
              $page = substr($this->agent->referrer(), 0, $pos);
              redirect($page."/edit");
            }

      if($this->input->post('staat_hinzuf')) {
          $this->load->view('pages/staaten/staaten_add');
        }

      if($this->input->post('staat_entf')) {
          $this->load->view('pages/staaten/staaten_delete');
        }
        else {
            $this->load->view('pages/staaten/staaten_edit', $data);
          }
          $this->load->view('templates/footer');

      } else {
        $pos = strrpos($this->agent->referrer(), "/");
        $page = substr($this->agent->referrer(), 0, $pos);

        redirect($page);
      }

  }


  public function add() {
    if($this->session->userdata('logged_in')) {

      if($this->input->post('hinzufuegen')) {
        $this->form_validation->set_rules('kuerzel', 'Kuerzel', 'required|min_length[3]|max_length[3]');
        $this->form_validation->set_rules('land_lang', 'Laendername', 'required|min_length[3]|max_length[30]');
        $this->form_validation->set_rules('land_lang_en', 'Country name', 'min_length[3]|max_length[30]');
        $this->form_validation->set_rules('land_navi', 'Naviname', 'min_length[3]|max_length[20]');
        $this->form_validation->set_rules('land_navi_en', 'Menu name', 'min_length[3]|max_length[20]');
        $this->form_validation->set_rules('shs_ahs', 'shs_ahs', 'required|min_length[3]|max_length[3]');
          if($this->form_validation->run() == FALSE) {
            echo "falsch";
          }  else {

            $this->staaten_model->add_staat($this->input->post('kuerzel'),
                                             $this->input->post('land_lang'),
                                             $this->input->post('land_lang_en'),
                                             $this->input->post('land_navi'),
                                             $this->input->post('land_navi_en'),
                                             $this->input->post('shs_ahs')
                                           );

            $this->textestadt_model->add_staaten($this->input->post('absatz1'), $this->input->post('absatz2'), $this->input->post('absatz3'), $this->input->post('absatz4'), $this->input->post('kuerzel'));

            $pos = strrpos($this->agent->referrer(), "/");
            $page = substr($this->agent->referrer(), 0, $pos);
            redirect($page."/edit");
          }
        }

      } else {
        $pos = strrpos($this->agent->referrer(), "/");
        $page = substr($this->agent->referrer(), 0, $pos);

        redirect($page);
      }
  }

  public function delete() {
    if($this->session->userdata('logged_in')) {
      if($this->input->post('loeschen')) {
        $this->staaten_model->delete_staat($this->input->post('eintr_loeschen'));
        $this->bilder_model->delete_img_tags($this->input->post('eintr_loeschen'));
        $pos = strrpos($this->agent->referrer(), "/");
        $page = substr($this->agent->referrer(), 0, $pos);
        redirect($page."/edit");
      }
      else {
        $pos = strrpos($this->agent->referrer(), "/");
        $page = substr($this->agent->referrer(), 0, $pos);

        redirect($page);
      }
    }
  }


}

 ?>
