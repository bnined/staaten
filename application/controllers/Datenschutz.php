<?php
class Datenschutz extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    //$this->load->library('session');  -->autoload
    $this->load->library('user_agent');
    $this->load->model(array('textestadt_model', 'staaten_model'));

    //$this->session->lang = "de";
    if($this->input->get("de")) {
      $this->session->lang = "de";
    } elseif($this->input->get("en")) {
      $this->session->lang = "en";
    }
  }


  function index() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['datenschutz'] = $this->textestadt_model->get_datenschutz();

    $this->load->view('pages/datenschutz/datenschutz', $data);
    $this->load->view('templates/footer');
  }

  function edit() {
    $this->load->library('user_agent');

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    //if(isset($_SESSION["logged_in"])) {
    if($this->session->userdata('logged_in')) {
      if($this->input->post('eintragen')) {
  //    if(isset($_POST["eintragen"])) {
        $this->textestadt_model->change_datenschutz($this->input->post('datenschutztext'));
      }

      $data['datenschutz'] = $this->textestadt_model->get_datenschutz();

      $this->load->view('pages/datenschutz/datenschutz_edit', $data);

    } else {
    //  $data['datenschutz'] = $this->textestadt_model->get_datenschutz();
    //  $this->load->view('pages/datenschutz/datenschutz', $data);    vmtl. besser redirect
    $pos = strrpos($this->agent->referrer(), "/");
    $page = substr($this->agent->referrer(), 0, $pos);

    redirect($page);
    }
    $this->load->view('templates/footer');
  }
}

 ?>
