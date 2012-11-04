<?php

class Appointment extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            
            $this->load->model('appointment_model');
            $this->load->model('patient_model');
            $this->load->model('settings_model');
            $this->load->helper('url');
            
            $prefs = array (
               'show_next_prev'  => TRUE,
                'next_prev_url'   => base_url() . 'index.php/appointment/index',
             );
            $this->load->library('calendar', $prefs);
            
        }

	public function index($year = NULL,$month = NULL,$day=NULL)
	{
            if ($year == NULL) 
                {$year = date("Y");}
            if ($month == NULL) 
                {$month = date("n");}
            if ($day == NULL) 
                {$day = date("j");}    
            $data['year']=$year;
            $data['month']=$month;
            $data['day']=$day;
            $appointment_date = date("Y-n-j",gmmktime(0, 0, 0, $month, $day, $year));
            $data['appointments']= $this->appointment_model->get_appointments($appointment_date);
            $data['start_time']=$this->settings_model->get_start_time();
            $data['end_time']=$this->settings_model->get_end_time();
            $this->load->view('templates/header');
            $this->load->view('templates/menu');
            $this->load->view('appointments/browse',$data);
            $this->load->view('templates/footer');
	}
        
        public function edit($year = NULL,$month = NULL,$day=NULL,$time=NULL)
	{
            if ($year == NULL) 
                {$year = date("Y");}
            if ($month == NULL) 
                {$month = date("n");}
            if ($day == NULL) 
                {$day = date("j");}
            
            $app_dt = date("j-n-Y",gmmktime(0, 0, 0, $month, $day, $year));
            $data['appointment_date']= $app_dt;
            
            $data['appointment_time'] = $time;
            
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'End Time', 'required');
            $this->form_validation->set_rules('appointment_date', 'Date', 'required');
            
            if ($this->form_validation->run() === FALSE)
            {
                $data['appointment'] = $this->appointment_model->get_appointment_at($app_dt,$time);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('appointments/edit',$data);
                $this->load->view('templates/footer');
            }
            else
            {
                $this->appointment_model->add_appointment();
                $year = date("Y",strtotime($this->input->post('appointment_date')));
                $month = date("m",strtotime($this->input->post('appointment_date')));
                $day = date("d",strtotime($this->input->post('appointment_date')));
                $this->index($year,$month,$day);
            }
	}
        public function add($patient_id)
	{
            $this->load->helper('form');
            $this->load->library('form_validation');
            
            //$this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('start_time', 'Start Time', 'required');
            $this->form_validation->set_rules('end_time', 'End Time', 'required');
            $this->form_validation->set_rules('appointment_date', 'Date', 'required');
            $this->form_validation->set_rules('patient_id', 'Patient', 'required');
            
            if ($this->form_validation->run() === FALSE)
            {    
                $data['patient'] = $this->patient_model->get_patient_detail($patient_id);
                $this->load->view('templates/header');
                $this->load->view('templates/menu');
                $this->load->view('appointments/add',$data);
                $this->load->view('templates/footer');
            }
            else{
                $this->appointment_model->add_patient_appointment();
                /*$year = date("Y",strtotime($this->input->post('appointment_date')));
                $month = date("m",strtotime($this->input->post('appointment_date')));
                $day = date("d",strtotime($this->input->post('appointment_date')));*/
                $this->index();
            }
	}
        public function delete($id,$appointment_date){
            $year = date("Y",strtotime($appointment_date));
            $month = date("m",strtotime($appointment_date));
            $day = date("d",strtotime($appointment_date));
            $this->appointment_model->delete_appointment($id); 
            $this->index($year,$month,$day);
        }
}
?>