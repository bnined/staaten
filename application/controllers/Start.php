<?php
class Start extends CI_Controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->library('user_agent');
    $this->load->model(array('textestadt_model', 'faq_model', 'news_model', 'staaten_model', 'admin_model', 'bilder_model'));

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
    //$this->admin_model->logout();

    $this->load->view('templates/header', $data);

    /* ========== Body ========= */
    /* ------ Headerbild ---- */
    $data['start1'] = $this->bilder_model->get_img_tags('start1');

    /* ------ Teaser Konzept ---- */
    $data['konzeptteaser'] = $this->textestadt_model->get_konzept_teaser();

    /* ------ Teaser FAQ ---- */
    $data['faqteaser'] = $this->faq_model->get_faq_teaser();

    /* ------ Teaser Staaten ---- */
    $data['staatenteaser'] = $this->textestadt_model->get_staaten_teaser();
    $data['laenderliste_shs'] = $this->staaten_model->get_staatenliste_shs();

    /* ------ Zwischenbild ---- */
    $data['start2'] = $this->bilder_model->get_img_tags('start2');

    /* ------ Teaser Kritik ---- */
    $data['kritikteaser'] = $this->textestadt_model->get_kritik_teaser();

    /* ------ Teaser News ---- */

    $data['newsteaser'] = $this->news_model->get_news_teaser();

    $this->load->view('pages/start/start', $data);

    /* ========== Footer ========= */
    $this->load->view('templates/footer');
  }

  function edit() {
    if($this->session->userdata('logged_in')) {
        /* ========== Header ========= */
        $data['laenderliste'] = $this->staaten_model->get_staatenliste();
        //$this->admin_model->logout();

        $this->load->view('templates/header', $data);

        /* ========== Body ========= */
        /* ------ Headerbild ---- */
        $upload['bild'] = 'start1';
        $upload['base'] = 'start';
        $upload['error'] = ' ';
        $data['bildupload1'] = $this->load->view('uploads/upload_form', $upload, TRUE);

        $data['start1'] = $this->bilder_model->get_img_tags('start1');

        /* ------ Teaser Konzept ---- */
        $data['konzeptteaser'] = $this->textestadt_model->get_konzept_teaser();

        if($this->input->post('konzept_aen')) {
          $this->textestadt_model->change_teaser($this->input->post('konz_teaser'), 'konzept');
        }
        $data['konzeptteaser'] = $this->textestadt_model->get_konzept_teaser();

        /* ------ Teaser FAQ ---- */
        $data['faqteaser'] = $this->faq_model->get_faq_teaser();
        $data['faqfragen'] = $this->faq_model->get_faq_teaser_select();

        //if(isset($_POST["faq_aendern"])) {
        if($this->input->post('faq_aendern')) {
          $this->faq_model->clear_faqteaser_liste();
          for($i = 1; $i <= 5; $i++) {
            $this->faq_model->change_faqteaser_liste($i, $this->input->post($i));
          }
        }

        $data['faqteaser'] = $this->faq_model->get_faq_teaser();
        $data['faqfragen'] = $this->faq_model->get_faq_teaser_select();
        $data['faqselected'] = $this->faq_model->get_faq_teaser_selected();


        /* ------ Teaser Staaten ---- */
        $data['staatenteaser'] = $this->textestadt_model->get_staaten_teaser();
        $data['laenderliste_shs'] = $this->staaten_model->get_staatenliste_shs();

        if($this->input->post('staaten_aen')) {
          $this->textestadt_model->change_teaser($this->input->post('staat_teaser'), 'staaten');
        }

        $data['staatenteaser'] = $this->textestadt_model->get_staaten_teaser();
        //$data['laenderliste_shs'] = $this->staaten_model->get_staatenliste_shs();

        /* ------ Zwischenbild ---- */
        $upload['bild'] = 'start2';
        $upload['base'] = 'start';
        $upload['error'] = ' ';
        $data['bildupload2'] = $this->load->view('uploads/upload_form', $upload, TRUE);

        $data['start2'] = $this->bilder_model->get_img_tags('start2');
      //  $this->load->view('uploads/upload_form', array('error' => ' ' ));

        /* ------ Teaser Kritik ---- */
        $data['kritikteaser'] = $this->textestadt_model->get_kritik_teaser();

        if($this->input->post('kritik_aen')) {
          $this->textestadt_model->change_teaser($this->input->post('krit_teaser'), 'kritik');
        }

        $data['kritikteaser'] = $this->textestadt_model->get_kritik_teaser();

        /* ------ Teaser News ---- */

        $data['newsteaser'] = $this->news_model->get_news_teaser();

        $this->load->view('pages/start/start_edit', $data);

        /* ========== Footer ========= */
        $this->load->view('templates/footer');
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }
  }

}
 ?>
