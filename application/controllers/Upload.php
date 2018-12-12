<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url', 'security'));
                //$this->load->library('session');
        }

        /*public function index()
        {
                $this->load->view('uploads/upload_form', array('error' => ' ' ));
        }*/

        public function do_upload()
        {
                $bildname = $this->input->post('bildname');

                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name']            = $bildname;
                $config['overwrite']            = true;

                $this->load->library('upload', $config);
                $this->load->model('bilder_model');

                if ( ! $this->upload->do_upload('bilder')) {

                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('uploads/upload_form', $error);

                } else {

                  if ($this->security->xss_clean($this->input->post('bilder'), TRUE) === FALSE) {
                      $error = array('error' => 'Falsches Dateiformat');
                    } else {
                      $data = array('upload_data' => $this->upload->data(), 'base' => $this->input->post('bildbase'));
                      $this->bilder_model->set_img_tags($this->input->post('bildname'), $this->input->post('title_dt'), $this->input->post('alt_dt'), $this->input->post('title_en'), $this->input->post('alt_en'));
                      $this->load->view('uploads/upload_success', $data);
                    }

                }
        }
}
?>
