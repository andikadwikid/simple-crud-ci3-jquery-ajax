<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Add_attendance extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			],
			'employee_id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
			],
			'check_in' => [
				'type' => 'TIMESTAMP',
			],
			'check_out' => [
				'type' => 'TIMESTAMP',
			],

		]);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('attendance');

		$this->dbforge->add_column('attendance', [
			'CONSTRAINT attendance_employee_id FOREIGN KEY (employee_id) REFERENCES employee(id) ON DELETE CASCADE ON UPDATE CASCADE'
		]);
	}

	public function down()
	{
		$this->dbforge->drop_table('attendance');
	}
}
