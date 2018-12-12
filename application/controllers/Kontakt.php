<?php

class Kontakt extends CI_controller {
  public function __construct() {
    parent::__construct();
    $this->load->helper(array('url', 'form'));
    $this->load->library('form_validation');
    //$this->load->library('session');  -->autoload
    $this->load->library('user_agent');
    $this->load->model(array('kontakt_model', 'staaten_model', 'bilder_model'));

    //$this->session->lang = "de";
    if($this->input->get("de")) {
      $this->session->lang = "de";
    } elseif($this->input->get("en")) {
      $this->session->lang = "en";
    }
  }

  function index() {
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data["kontakt"] = $this->kontakt_model->get_kontakttext();
    //$this->load->view('pages/kontakt/kontakt_email');
    $this->load->view('pages/kontakt/kontakt', $data);
    $this->load->view('templates/footer');

  }

  function edit() {
    $data['laenderliste'] = $this->staaten_model->get_staatenliste();
    $this->load->view('templates/header', $data);

    $data['kontakt'] = $this->kontakt_model->get_kontakttext();

    if($this->session->userdata('logged_in')) {
      if($this->input->post('aendern')) {
      $this->kontakt_model->change_kontakttext($this->input->post('volltext') /*, $this->input->post('sender'), $this->input->post('betreff'), $this->input->post('nachricht'), $this->input->post('button')*/);
      }
      $data['kontakt'] = $this->kontakt_model->get_kontakttext();

      if($this->input->post('generieren')) {
        $email = imagecreatetruecolor(200, 50);
        $hintergrundfarbe = imagecolorallocate($email, 255, 255, 255);
        imagefilledrectangle($email, 0, 0, 199, 199, $hintergrundfarbe);

        $schriftfarbe = imagecolorallocate($email, 51, 51, 204);
        $text = $this->input->post('email');
        imagestring($email, 5, 10, 10, $text, $schriftfarbe);
        //imagettftext($email, 14, 0, 10, 10, $schriftfarbe, base_url('system/fonts/texb.ttf'), $text);
        imagepng($email, 'uploads/kontakt.png');
        imagedestroy($email);
      }

      $this->load->view('pages/kontakt/kontakt_edit', $data);

      $this->load->view('templates/footer');
    } else {
      $pos = strrpos($this->agent->referrer(), "/");
      $page = substr($this->agent->referrer(), 0, $pos);

      redirect($page);
    }
  }

  function email() {
    $this->form_validation->set_rules('sender', 'Absender', 'trim|required|valid_email',
                                      array(
                                        'required' => 'Ihre Nachricht enthält keinen Absender',
                                        'valid_email' => 'bitte geben Sie eine gültige Email-Adresse an'));
    $this->form_validation->set_rules('betreff', 'Betreff', 'max_length[50]',
                                      array(
                                        'max_length' => 'Betreffzeile ist zu lang'
                                      ));
    $this->form_validation->set_rules('nachricht', 'Nachricht', 'max_length[5]|required',
                                      array(
                                        'required' => 'Ihre Nachricht enthält keinen Text',
                                        'max_length' => 'maximale Anzahl an Zeichen überschritten'
                                      ));

    if($this->input->post('button')) {
      if ($this->form_validation->run() == FALSE)
                  {
                          $this->index();
                  }
                  else
                  {
                    $this->load->library('email');

                    echo "gesendet von: " . $this->input->post('sender') . "<br/>";
                    echo "Betreff: " . $this->input->post('betreff') . "<br/>";
                    echo "Nachricht: " . $this->input->post('nachricht') . "<br/>";
                  }
    }

    /*if($this->input->post('button')) {
      $this->load->library('email');

      echo "gesendet von: " . $this->input->post('sender') . "<br/>";
      echo "Betreff: " . $this->input->post('betreff') . "<br/>";
      echo "Nachricht: " . $this->input->post('nachricht') . "<br/>";*/

      //$this->email->send();
  //  }

  }



}

 ?>
