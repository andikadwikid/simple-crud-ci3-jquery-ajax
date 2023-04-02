<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('employee_model');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}
	public function index()
	{
		$data['employees'] = $this->employee_model->getAll();
		$this->load->view('employee/index', $data);
	}

	public function show_Employee()
	{
		$data['employees'] = $this->employee_model->getAll();
		$this->load->view('employee/employee-list', $data);
	}

	public function create_Employee()
	{
		$this->load->view('employee/add-employee');
	}

	public function post()
	{
		$employee = $this->employee_model;
		$validation = $this->form_validation;
		$validation->set_rules($employee->rules());

		if ($validation->run()) {
			$data = [
				'success' => true,
			];
			return $employee->save();
		} else {
			$data = [
				'success' => false,
				'errors' => [
					'name_error' => form_error('name'),
					'address_error' => form_error('address'),
					'phone_error' => form_error('phone'),
					'email_error' => form_error('email'),
				]
			];
		}
		echo json_encode($data);
	}

	public function edit_Employee($id = null)
	{
		$employee = $this->employee_model;
		$data['employee'] = $employee->getById($id);

		$this->load->view('employee/edit-employee', $data);
	}

	public function update_Employee($id = null)
	{
		$employee = $this->employee_model;
		$validation = $this->form_validation;
		$validation->set_rules($employee->rules());

		if ($validation->run()) {
			$data = [
				'success' => true,
				'csrf_hash' => $this->security->get_csrf_hash()
			];
			$employee->update($id);

			echo json_encode($data);
		} else {
			$data = [
				'success' => false,
				'csrf_hash' => $this->security->get_csrf_hash(),
				'errors' => [
					'name_error' => form_error('name'),
					'address_error' => form_error('address'),
					'phone_error' => form_error('phone'),
					'email_error' => form_error('email'),
				]
			];

			echo json_encode($data);
		}
	}

	public function destroy($id = null)
	{
		if (!isset($id)) show_404();

		$this->employee_model->delete($id);
	}
}
