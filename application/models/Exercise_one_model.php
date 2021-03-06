<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercise_one_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function get_router_listing($router_id = null)
	{
		$this->db->where('status', 'active');

		if (!empty($router_id)) {
			$this->db->where('router_id', (int)$router_id);
		}
		$result = $this->db->get('router_properties');
		return $result->result_array();
	}

	function add_data($data)
	{

		$insert_query = $this->db->insert_string('router_properties', $data);
		$insert_query = str_replace('INSERT INTO','INSERT IGNORE INTO',$insert_query);
		return $this->db->query($insert_query);

		// try {
		// 	$this->db->insert('router_properties', $data);
		// } catch (Exception $e) {
		// 	return false;
		// }

	}

	function delete_data($router_id)
	{
		$this->db->where("router_id", $router_id);
		$this->db->limit(1);
		return $this->db->delete('router_properties');
	}

	function update_data($data, $router_id)
	{
		$this->db->where('router_id', $router_id);
		return $this->db->update('router_properties', $data);
	}


}

/* End of file Seo_report_v2_model.php */
/* Location: ./application/models/Seo_report_v2_model.php */