<?php

class m190129_072127_user extends CDbMigration
{
	public function up()
	{

		$this->createTable('{{user}}', array(
			'id' => 'pk',
			'login' => 'varchar(32) NOT NULL',
			'password' => 'varchar(32) NOT NULL',
			'created' => 'datetime NOT NULL',
			'role' => 'varchar(16) NOT NULL',
		), 'ENGINE=InnoDB CHARSET=utf8');

		$this->insert('{{user}}', array(
			'login' => 'admin',
			'password' => '0192023a7bbd73250516f069df18b500',
			'created' => date("Y-m-d H:i:s"),
			'role' => User::ROLE_USER,

		));
	}

	public function down()
	{
		$this->dropTable('{{user}}');
	}


}