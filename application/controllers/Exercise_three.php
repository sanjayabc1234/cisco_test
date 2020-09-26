<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercise_three extends CI_Controller {


	function __construct()
	{
		parent::__construct();
		$this->load->model("exercise_one_model", "exercise_three");
	}

	public function index(){}


	//ref: https://stackoverflow.com/questions/43406721/token-based-authentication-in-codeigniter-rest-server-library
	function create_token($customer_id)
	{
		$this->load->database();

		// ***** Generate Token *****
		$char = "bcdfghjkmnpqrstvzBCDFGHJKLMNPQRSTVWXZaeiouyAEIOUY!@#%";
		$token = '';

		for ($i = 0; $i < 47; $i++) $token .= $char[(rand() % strlen($char))];

		// ***** Insert into Database *****
		$sql = "INSERT INTO api_tokens SET `token` = ?, customer_id = ?;";

		$this->db->query($sql, array($token, $customer_id));

		return array('http_code' => 200, 'token' => $token);
	}

	function get_token()
	{
		$user_id = $this->input->post('user_id');
		var_dump($token = $this->input->request_headers());die();
		//check any previous active token
		$this->db->where("customer_id", (int)$user_id);
		$this->db->where("date >= ", date("Y-m-d H:i:s", strtotime('-3600 seconds'))); //60 * 60 = 1 hour
		$res = $this->db->get("api_tokens");

		if (!empty($res) && $res->num_rows() > 0) {
			$token = $res->result_row();
			$token = $token['token'];
		}else{
			$token = $this->create_token($user_id);
			$token = $token['token'];
		}

		return $token;
	}

	function get_all_routers()
	{
		$token = $this->input->request_headers();

		if (!isset($token['x-token'])) {
			header("Content-Type: application/json");
			echo json_encode(array(
				"error" => "Missing x-token in the request.",
				"data" => array(),
				"msg" => ""
			));
			die();
		}

		$data = $this->exercise_three->get_router_listing();

		header("Content-Type: application/json");
		echo json_encode(array(
			"error" => "",
			"data" => $data,
			"msg" => "ok"
		));

		die();

	}

}
