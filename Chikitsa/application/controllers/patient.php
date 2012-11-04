<?php

class Patient extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('contact_model');
            $this->load->model('patient_model');
            $this->load->helper('url');
        }

	public function index()
	{
            $this->load->helper('form');
            
            $name = $this->input->post('search_name');
            $data['patients'] = $this->patient_model->find_patient();  
            
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('patient/browse',$data);
            $this->load->view('templates/footer');
	}
        public function insert()
        {
            $contact_id = $this->contact_model->insert_contact();
            $this->contact_model->insert_address($contact_id);
            $patient_id = $this->patient_model->insert_patient($contact_id);
            
            $this->visit($patient_id);
        }
        public function visit($patient_id = NULL){
            $this->load->helper('form');
            $this->load->library('form_validation');
	
            $this->form_validation->set_rules('notes', 'Notes', 'required');
	
            if ($this->form_validation->run() === FALSE)
            {
                $data['patient_id']=$patient_id;
                $data['patient']=$this->patient_model->get_patient_detail($patient_id); 
                $data['addresses']=$this->contact_model->view_contact_address($data['patient']['contact_id']); 
                $data['visits']=$this->patient_model->get_previous_visits($patient_id); 
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('patient/visit',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                    $this->patient_model->insert_visit();
                    $patient_id = $this->input->post('patient_id');
                    $data['patient_id']=$patient_id;
                    $data['patient']=$this->patient_model->get_patient_detail($patient_id); 
                    $data['addresses']=$this->contact_model->view_contact_address($data['patient']['contact_id']); 
                    $data['visits']=$this->patient_model->get_previous_visits($patient_id); 
                    $this->load->view('templates/header');
                    $this->load->view('templates/menu');
                    $this->load->view('patient/visit',$data);
                    $this->load->view('templates/footer');
            }
        }
        public function delete($patient_id)
        {
            $this->patient_model->delete_patient($patient_id);
            $this->index();
        }
}
?>