<?php

class Employee_model extends CI_Model
{
	public function rules()
	{
		return [
			[
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required',
				'errors' => [
					'required' => 'Name is required'
				]
			],
			[
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|is_unique[employee.email]',
				'errors' => [
					'required' => 'Email is required',
					'is_unique' => 'Email already exists'
				]
			],
			[
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'required',
				'errors' => [
					'required' => 'Address is required'
				]
			],
			[
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'required',
				'errors' => [
					'required' => 'Phone is required'
				]
			]
		];
	}

	public function getAll()
	{
		$result = $this->db->get('employee')->result();
		return $result;
	}

	public function save()
	{
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		];

		$this->db->insert('employee', $data);
	}

	public function update($id)
	{
		$data = [
			'name' => $this->input->post('name'),
			'email' => $this->input->post('email'),
			'address' => $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'updated_at' => date('Y-m-d H:i:s'),
		];

		$this->db->where('id', $id);
		$this->db->update('employee', $data);
	}

	public function getById($id)
	{
		return $this->db->get_where('employee', ['id' => $id])->row();
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('employee');
	}
}
