<?php

class Admin extends CI_controller {



  public function __construct() {
    parent::__construct();
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    $this->load->model(array('admin_model', 'staaten_model'));
  }


  public function index($seite="pages/admin/admin") {
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);
    if($this->session->userdata('logged_in')) {
      $seite ="pages/admin/adminsuccess";
    }
    $this->load->view($seite);
    $this->load->view('templates/footer');
  }


  public function login_process() {
    $this->form_validation->set_rules('benutzername', 'Name', 'trim|htmlspecialchars|required', array('required' => 'Bitte %s angeben.'));
    $this->form_validation->set_rules('password', 'Passwort', 'trim|htmlspecialchars|required', array('required' => 'Bitte %s angeben.'));
    if($this->form_validation->run() == FALSE) {
    //if($this->form_validation->run() == TRUE) {
      //if(isset($this->session->userdata['logged_in'])){
        //$this->index('pages/adminsuccess');
        //}else{
          $this->index('pages/admin/admin');
      //}
    } else {
      $data = array(
              'benutzername' => $this->security->xss_clean($this->input->post('benutzername')),
              'password' => $this->security->xss_clean($this->input->post('password'))
              );

      $result = $this->admin_model->login($data);

      if ($result == TRUE) {

        $user['benutzername'] = $this->input->post('benutzername');
        $user['password'] = $this->input->post('password');
        $result = $this->admin_model->login($user);
        if ($result != false) {

        // Session regenerate
        $this->session->sess_regenerate();
        // Add user data in session
        $this->session->logged_in = array('benutzername' => $user['benutzername']);
        //automatic logout after 1 hour
        $this->session->mark_as_temp('logged_in', 3600);

        $this->index('pages/admin/adminsuccess');
        }
      } else {
        $data = array(
          'error_message' => 'Invalid Username or Password'
        );
        $this->index('pages/admin/admin');
      }
    }
  }



  public function logout() {
      $this->load->library('user_agent');
      $sess_array = array(
        'username' => ''
        );
      $this->session->unset_userdata('logged_in', $sess_array);
      $this->session->sess_regenerate();

      $page = substr($this->agent->referrer(), strlen(base_url())+10);
      redirect($page);
    }


  public function bearbeiten() {
      $this->load->library('user_agent');

      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page."/edit");

  }


}


 ?>
