<?php
class Settings_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
        public function get_settings()
        {
            $query = $this->db->get('settings');
            return $query->row_array();
        }
        public function save_settings()
        {
            $data->start_time = $this->input->post('start_time');
            $data->end_time = $this->input->post('end_time');
            $this->db->update('settings', $data, array('settings_id' =>  1));
        }
        public function get_start_time()
        {
            $query = $this->db->get('settings');
            $row = $query->row_array();
            return $row['start_time'];
        }
        public function get_end_time()
        {
            $query = $this->db->get('settings');
            $row=$query->row_array();
            return $row['end_time'];
        }
}
?>
