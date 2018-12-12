<?php
class News extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->helper('url');
    $this->load->library('form_validation');
  //  $this->load->library('session');  -->autoload
    $this->load->library('user_agent');
    $this->load->model(array('news_model', 'staaten_model'));
    $this->load->library('pagination');

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

    $config['base_url'] = 'http://localhost/00_Staaten/index.php/news/index';
    $config['total_rows'] = $this->news_model->count_news();
    $config['per_page'] = 20;
    $config['num_links'] = 2;
    $config['full_tag_open'] = '<p>';
    $config['full_tag_close'] = '</p>';
    $config['use_page_numbers'] = TRUE;
    $config['uri_segment'] = 3;

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['news'] = $this->news_model->get_news_full($config['per_page'], $page);
    $data['links'] = $this->pagination->create_links();

    $this->load->view('pages/news/news', $data);
    $this->load->view('templates/footer');
  }

  function edit() {
    /* ========== Header ========= */
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);
    $config['base_url'] = 'http://localhost/00_Staaten/index.php/news/index';
    $config['total_rows'] = $this->news_model->count_news();
    $config['per_page'] = 20;
    $config['num_links'] = 2;
    $config['use_page_numbers'] = TRUE;
    $config['uri_segment'] = 3;

    $this->pagination->initialize($config);
    $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $data['news'] = $this->news_model->get_news_full($config['per_page'], $page);
    $data['links'] = $this->pagination->create_links();

    if($this->session->userdata('logged_in')) {
      if($this->input->post('loeschen')) {
        $this->news_model->delete_news($this->input->post('id'));
      }
      if($this->input->post('hinzufuegen')) {
        $this->news_model->add_news($this->input->post('datum'),
                                    $this->input->post('text_de'),
                                    $this->input->post('slug_de'),
                                    $this->input->post('text_en'),
                                    $this->input->post('slug_en'),
                                    $this->input->post('link'),
                                    $this->input->post('origin')
                                  );
      }

      $data['news'] = $this->news_model->get_news_full($config['per_page'], $page);
      $data['links'] = $this->pagination->create_links();
      $this->load->view('pages/news/news_edit', $data);
      $this->load->view('templates/footer');
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect(site_url('start/index'));
    }
  }
}
