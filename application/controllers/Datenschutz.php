<?php
class Datenschutz extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('user_agent');
    $this->load->model(array('textestadt_model', 'staaten_model'));

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

    $data['datenschutz'] = $this->textestadt_model->get_datenschutz();

    $this->load->view('pages/datenschutz/datenschutz', $data);
    $this->load->view('templates/footer');
  }

  public function edit() {
    $this->load->library('user_agent');

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    if($this->session->userdata('logged_in')) {
      if($this->input->post('eintragen')) {
        $this->textestadt_model->change_datenschutz($this->input->post('datenschutztext'));
      }

      $data['datenschutz'] = $this->textestadt_model->get_datenschutz();

      $this->load->view('pages/datenschutz/datenschutz_edit', $data);

    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }
    $this->load->view('templates/footer');
  }
}

 ?>
