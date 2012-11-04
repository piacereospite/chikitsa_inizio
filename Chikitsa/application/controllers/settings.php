<?php

class Settings extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->helper('url');
            $this->load->model('settings_model');
        }

	public function edit()
	{
            $this->load->helper('form');
            $this->load->library('form_validation');
	
            $this->form_validation->set_rules('start_time', 'Clinic Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'Clinic End Time', 'required');
            
            if ($this->form_validation->run() === FALSE)
            {
                $data['settings'] = $this->settings_model->get_settings();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('settings/browse',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->settings_model->save_settings();
                $data['settings'] = $this->settings_model->get_settings();
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('settings/browse',$data);
                $this->load->view('templates/footer');
            }
	}
}
?>