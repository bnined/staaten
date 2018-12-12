<?php
class Faq extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    //$this->load->library('session');  -->autoload
    $this->load->library('user_agent');
    $this->load->model(array('faq_model', 'staaten_model'));

    //$this->session->lang = "de";
    //if($this->input->get("de")) {
    if($this->session->lang == "" || $this->input->get("de")) {
      $this->session->lang = "de";
    } elseif($this->input->get("en")) {
      $this->session->lang = "en";
    }
  }


  function index() {

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();
    $data['faqfrage'] = $this->faq_model->get_faq_fragen();
    $this->load->view('pages/faq/faq', $data);
    $this->load->view('templates/footer');
  }

  function edit() {

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();

    $data['faq'] = $this->faq_model->get_faq_fragen_edit();

    $data['faq_liste'] = $this->faq_model->get_faq_teaser_select();

    if($this->session->userdata('logged_in')) {
      if($this->input->post('aendern')) {
        $this->faq_model->change_faq($this->input->post('einleitungstext'), 'einleitung');
      }
      $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();

      $this->load->view('pages/faq/faq_edit', $data);

      if($this->input->post('faq_aend')) {
          $this->load->view('pages/faq/faq_change');
        }

      if($this->input->post('faq_hinzuf')) {
          $this->load->view('pages/faq/faq_add');
        }

      if($this->input->post('faq_entf')) {
          $this->load->view('pages/faq/faq_delete');
        }

    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }

    $this->load->view('templates/footer');
  }


  function change() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();
    $data['faq'] = $this->faq_model->get_faq_fragen_edit();

    if($this->session->userdata('logged_in')) {
      if($this->input->post('aendern')) {
        $nr = count($data['faq']);
        for ($i = 1; $i <= $nr; $i++) {
          $this->faq_model->change_faq($this->input->post('faq'.$i), 'faq'.$i);
        }
      }
    $data['faq'] = $this->faq_model->get_faq_fragen_edit();
    $this->load->view('pages/faq/faq_edit', $data);
    $this->load->view('pages/faq/faq_change', $data);
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }

    $this->load->view('templates/footer');

  }

  function add() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();
    $data['faq'] = $this->faq_model->get_faq_fragen_edit();

    if($this->session->userdata('logged_in')) {
      if($this->input->post('hinzufuegen')) {
        $nr = count($data['faq']);
        $this->faq_model->add_faq($this->input->post('faq_lang'), $this->input->post('faq_kurz'));
      }
    $data['faq'] = $this->faq_model->get_faq_fragen_edit();
    $this->load->view('pages/faq/faq_edit', $data);
    $this->load->view('pages/faq/faq_add', $data);
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }

    $this->load->view('templates/footer');

  }

function delete() {
  $data['laenderliste'] = $this->staaten_model->get_staatenliste();
  $this->load->view('templates/header', $data);

  $data['faq_einleitung'] = $this->faq_model->get_faq_einleitung();
  $data['faq_liste'] = $this->faq_model->get_faq_teaser_select_2();

  if($this->session->userdata('logged_in')) {
    if($this->input->post('loeschen')) {
      $this->faq_model->delete_faq($this->input->post('eintr_loeschen'));
    }
  $data['faq_liste'] = $this->faq_model->get_faq_teaser_select_2();
  $this->load->view('pages/faq/faq_edit', $data);
  $this->load->view('pages/faq/faq_delete', $data);
  } else {
    $pos = strrpos($this->agent->referrer(), "/");
    $page = substr($this->agent->referrer(), 0, $pos);

    redirect($page);
  }

  $this->load->view('templates/footer');

}

}
