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
			$this->session->set_flashdata('success', 'Berhasil disimpan');
			return $employee->save();
		}

		// error form for validation
		$errors = validation_errors();

		$this->session->set_flashdata('error', $errors);
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
			$employee->update($id);
		} else {
			$errors = [
				'error' => true,
				'name_error' => form_error('name'),
				'address_error' => form_error('address'),
				'phone_error' => form_error('phone'),
				'email_error' => form_error('email'),
			];
			echo json_encode($errors);
		}
	}

	public function destroy($id = null)
	{
		if (!isset($id)) show_404();

		$this->employee_model->delete($id);
	}
}
