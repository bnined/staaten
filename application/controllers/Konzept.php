<?php
class Konzept extends CI_Controller {
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

  function index() {

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['konzept'] = $this->textestadt_model->get_konzept('konzept');
    $data['konzeptbild1'] = $this->bilder_model->get_img_tags('konzeptbild1');
    $data['konzept2'] = $this->textestadt_model->get_konzept('konzept2');
    $data['konzept3'] = $this->textestadt_model->get_konzept('konzept3');
    $data['konzeptbild2'] = $this->bilder_model->get_img_tags('konzeptbild2');
    $data['konzept4'] = $this->textestadt_model->get_konzept('konzept4');
    $data['konzept5'] = $this->textestadt_model->get_konzept('konzept5');
    $this->load->view('pages/konzept/konzept', $data);

    $this->load->view('templates/footer');
  }


  function edit() {

    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['konzept'] = $this->textestadt_model->get_konzept('konzept');

    $upload['bild'] = 'konzeptbild1';
    $upload['base'] = 'konzept';
    $upload['error'] = ' ';
    $data['bildupload1'] = $this->load->view('uploads/upload_form', $upload, TRUE);
    $data['konzeptbild1'] = $this->bilder_model->get_img_tags('konzeptbild1');

    $data['konzept2'] = $this->textestadt_model->get_konzept('konzept2');
    $data['konzept3'] = $this->textestadt_model->get_konzept('konzept3');

    $upload['bild'] = 'konzeptbild2';
    $upload['base'] = 'konzept';
    $upload['error'] = ' ';
    $data['bildupload2'] = $this->load->view('uploads/upload_form', $upload, TRUE);
    $data['konzeptbild2'] = $this->bilder_model->get_img_tags('konzeptbild2');

    $data['konzept4'] = $this->textestadt_model->get_konzept('konzept4');
    $data['konzept5'] = $this->textestadt_model->get_konzept('konzept5');

    if($this->session->userdata('logged_in')) {
      if($this->input->post('aendern')) {
        $this->textestadt_model->change_konzept($this->input->post('konzept'), 'konzept');
        $this->textestadt_model->change_konzept($this->input->post('konzept2'), 'konzept2');
        $this->textestadt_model->change_konzept($this->input->post('konzept3'), 'konzept3');
        $this->textestadt_model->change_konzept($this->input->post('konzept4'), 'konzept4');
        $this->textestadt_model->change_konzept($this->input->post('konzept5'), 'konzept5');
      }

      $data['konzept'] = $this->textestadt_model->get_konzept('konzept');

      $upload['bild'] = 'konzeptbild1';
      $upload['base'] = 'konzept';
      $upload['error'] = ' ';
      $data['bildupload1'] = $this->load->view('uploads/upload_form', $upload, TRUE);
      $data['konzeptbild1'] = $this->bilder_model->get_img_tags('konzeptbild1');

      $data['konzept2'] = $this->textestadt_model->get_konzept('konzept2');
      $data['konzept3'] = $this->textestadt_model->get_konzept('konzept3');

      $upload['bild'] = 'konzeptbild2';
      $upload['base'] = 'konzept';
      $upload['error'] = ' ';
      $data['bildupload2'] = $this->load->view('uploads/upload_form', $upload, TRUE);
      $data['konzeptbild2'] = $this->bilder_model->get_img_tags('konzeptbild2');

      $data['konzept4'] = $this->textestadt_model->get_konzept('konzept4');
      $data['konzept5'] = $this->textestadt_model->get_konzept('konzept5');
      $this->load->view('pages/konzept/konzept_edit', $data);
      $this->load->view('templates/footer');
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }


  }

}

 ?>
