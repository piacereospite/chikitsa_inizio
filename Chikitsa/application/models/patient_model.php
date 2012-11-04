<?php
class Patient_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        public function search_patient($name=NULL)
	{
            if ($name != NULL)
            {
                $this->db->like('first_name', $name);
                $this->db->or_like('middle_name', $name); 
                $this->db->or_like('last_name', $name); 
                $this->db->order_by("first_name", "asc"); 
                $query = $this->db->get('view_patient');
                return $query->result_array();
            }
            $this->db->order_by("first_name", "asc"); 
            $query = $this->db->get('view_patient');
            return $query->result_array();
	}
        public function find_patient()
	{
            $first_name = $this->input->post('first_name');
            $middle_name = $this->input->post('middle_name');
            $last_name = $this->input->post('last_name');
            if ($first_name != NULL && $middle_name != NULL && $last_name != NULL)
            {
                $this->db->order_by("first_name", "asc"); 
                $query = $this->db->get_where('view_patient', array('first_name' => $first_name,'middle_name' => $middle_name,'last_name' => $last_name));
                return $query->result_array();
            }elseif ($first_name != NULL && $last_name != NULL)
            {
                $this->db->order_by("first_name", "asc"); 
                $query = $this->db->get_where('view_patient', array('first_name' => $first_name,'last_name' => $last_name));
                return $query->result_array();
            }elseif ($first_name != NULL && $last_name == NULL)
            {
                $this->db->order_by("first_name", "asc"); 
                $query = $this->db->get_where('view_patient', array('first_name' => $first_name));
                return $query->result_array();
            }elseif ($first_name == NULL && $last_name != NULL)
            {
                $this->db->order_by("first_name", "asc"); 
                $query = $this->db->get_where('view_patient', array('last_name' => $last_name));
                return $query->result_array();
            }
            $this->db->order_by("first_name", "asc"); 
            $query = $this->db->get('view_patient');
            return $query->result_array();
	}
        function insert_patient($contact_id)
        {
            $data['contact_id'] = $contact_id;
            $data['patient_since'] = date("Y-m-d");
            $this->db->insert('patient', $data);
            return $this->db->insert_id();
        }
        function delete_patient($patient_id)
        {
            $this->db->delete('patient', array('patient_id' => $patient_id)); 
        }
        public function get_previous_visits($patient_id)
        {
            $this->db->order_by("visit_date", "desc"); 
            $query = $this->db->get_where('visit', array('patient_id' => $patient_id));
            
            return $query->result_array();
        }
        public function get_patient_detail($patient_id){
            $query = $this->db->get_where('view_patient', array('patient_id' => $patient_id));
            return $query->row_array();
        }
        public function get_contact_id($patient_id){
            $query = $this->db->get_where('patient', array('patient_id' => $patient_id));
            $row = $query->row();
            return $row->contact_id;
        }
        public function insert_visit(){
            $data['patient_id'] = $this->input->post('patient_id');
            $data['notes'] = $this->input->post('notes');
            $data['type'] = $this->input->post('type');
            $data['visit_date'] = date("Y-m-d",strtotime($this->input->post('visit_date')));
            $this->db->insert('visit', $data);
        }
}
?>
