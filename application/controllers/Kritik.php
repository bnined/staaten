<?php
class Kritik extends CI_Controller {

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

    $data['kritik'] = $this->textestadt_model->get_kritik('kritik');

    $data['kritikbild1'] = $this->bilder_model->get_img_tags('kritikbild1');

    $data['kritik2'] = $this->textestadt_model->get_kritik('kritik2');
    $data['kritik3'] = $this->textestadt_model->get_kritik('kritik3');

    $data['kritikbild2'] = $this->bilder_model->get_img_tags('kritikbild2');

    $data['kritik4'] = $this->textestadt_model->get_kritik('kritik4');
    $this->load->view('pages/kritik/kritik', $data);
    $this->load->view('templates/footer');
  }


  public function edit() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);
    $data['kritik'] = $this->textestadt_model->get_kritik('kritik');

    $upload['bild'] = 'kritikbild1';
    $upload['base'] = 'kritik';
    $upload['error'] = ' ';
    $data['bildupload1'] = $this->load->view('uploads/upload_form', $upload, TRUE);
    $data['kritikbild1'] = $this->bilder_model->get_img_tags('kritikbild1');

    $data['kritik2'] = $this->textestadt_model->get_kritik('kritik2');
    $data['kritik3'] = $this->textestadt_model->get_kritik('kritik3');

    $upload['bild'] = 'kritikbild2';
    $upload['base'] = 'konzept';
    $upload['error'] = ' ';
    $data['bildupload2'] = $this->load->view('uploads/upload_form', $upload, TRUE);
    $data['kritikbild2'] = $this->bilder_model->get_img_tags('kritikbild2');

    $data['kritik4'] = $this->textestadt_model->get_kritik('kritik4');

    if($this->session->userdata('logged_in')) {
      if($this->input->post('aendern')) {
        $this->textestadt_model->change_kritik($this->input->post('kritik'), 'kritik');
        $this->textestadt_model->change_kritik($this->input->post('kritik2'), 'kritik2');
        $this->textestadt_model->change_kritik($this->input->post('kritik3'), 'kritik3');
        $this->textestadt_model->change_kritik($this->input->post('kritik4'), 'kritik4');
      }
      $data['kritik'] = $this->textestadt_model->get_kritik('kritik');

      $upload['bild'] = 'kritikbild1';
      $upload['base'] = 'konzept';
      $upload['error'] = ' ';
      $data['bildupload1'] = $this->load->view('uploads/upload_form', $upload, TRUE);
      $data['kritikbild1'] = $this->bilder_model->get_img_tags('kritikbild1');

      $data['kritik2'] = $this->textestadt_model->get_kritik('kritik2');
      $data['kritik3'] = $this->textestadt_model->get_kritik('kritik3');

      $upload['bild'] = 'kritikbild2';
      $upload['base'] = 'konzept';
      $upload['error'] = ' ';
      $data['bildupload2'] = $this->load->view('uploads/upload_form', $upload, TRUE);
      $data['kritikbild2'] = $this->bilder_model->get_img_tags('kritikbild2');

      $data['kritik4'] = $this->textestadt_model->get_kritik('kritik4');
      $this->load->view('pages/kritik/kritik_edit', $data);
      $this->load->view('templates/footer');

    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }


  }
}

 ?>
