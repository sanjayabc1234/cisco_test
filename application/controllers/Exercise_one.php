<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exercise_one extends CI_Controller {

	private $payload = array(
		'msg' => "",
		'error' => ''
	);


	function __construct()
	{
		parent::__construct();
		$this->load->model("exercise_one_model", "exercise_one");
	}

	public function index()
	{
		$this->load->view('exercise_one/header');
		$this->load->view('exercise_one/index');
		$this->load->view('exercise_one/footer');
	}


	public function list()
	{
		$result = array();
		$result['list'] = $this->exercise_one->get_router_listing();
		$this->load->view('exercise_one/header');
		$this->load->view('exercise_one/list', $result);
		$this->load->view('exercise_one/footer');
	}

	public function update()
	{
		$payload = $this->payload;

		if(empty($this->input->post())){

			$payload['error'] = "Access denied.";

			header("Content-Type: application/json");
			echo json_encode($payload);
			return false;
		}

		$data = $this->input->post();

		$final['sap_id'] = $data['sapid'];
		$final['hostname'] = $data['hostname'];
		$final['loopback'] = $data['loopback'];
		$final['mac_address'] = $data['macaddress'];

		if((int)$data['router_id'] > 0){
			$status = $this->exercise_one->update_data($final, (int)$data['router_id']);
		}else{
			$status = $this->exercise_one->add_data($final);
		}

		$payload['msg'] = empty($status) ? "" : "done";
		$payload['error'] = empty($status) ? "Could not process" : "";

		header("Content-Type: application/json");
		echo json_encode($payload);
		return false;
	}

	public function delete()
	{
		$payload = $this->payload;

		if(empty($this->input->post())){

			$payload['error'] = "Access denied.";

			header("Content-Type: application/json");
			echo json_encode($payload);
			return false;
		}

		$data = $this->input->post();

		$status = $this->exercise_one->delete_data((int)$data['router_id']);

		$payload['msg'] = empty($status) ? "" : "done";
		$payload['error'] = empty($status) ? "Could not process" : "";

		header("Content-Type: application/json");
		echo json_encode($payload);
		return false;
	}

	public function get_one()
	{
		$payload = $this->payload;

		if(empty($this->input->post())){

			$payload['error'] = "Access denied.";

			header("Content-Type: application/json");
			echo json_encode($payload);
			return false;
		}

		$data = $this->input->post();

		$data = $this->exercise_one->get_router_listing((int)$data['router_id']);

		$payload['msg'] = empty($data) ? "" : "done";
		$payload['error'] = empty($data) ? "Could not process" : "";
		$payload['data'] = isset($data[0]) ? $data[0] : array();

		header("Content-Type: application/json");
		echo json_encode($payload);
		return false;
	}
}
