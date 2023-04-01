<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Migration_Add_employee extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field([
			'id' => [
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			],
			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'UNIQUE' => TRUE,
			],
			'phone' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'address' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
			],
			'created_at' => [
				'type' => 'TIMESTAMP',
			],
			'updated_at' => [
				'type' => 'TIMESTAMP',
			],
		]);
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('employee');
	}

	public function down()
	{
		$this->dbforge->drop_table('employee');
	}
}
