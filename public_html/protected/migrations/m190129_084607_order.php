<?php

class m190129_084607_order extends CDbMigration
{
	public function up()
	{
		$this->createTable('{{questionnaire}}', array(
			'id' => 'pk',
			'created' => 'datetime NOT NULL',
			'user_id' => 'int(11) NOT NULL',
			'name_ur' => 'varchar(255) NULL',
			'name_ur_check' => 'boolean NOT NULL default 1',
			'fio_ur_contact' => 'varchar(255) NULL',
			'fio_ur_contact_check' => 'boolean NOT NULL default 1',
			'tel_ur_contact' => 'varchar(11) NULL',
			'tel_ur_contact_check' => 'boolean NOT NULL default 1',
			'email_ur_contact' => 'varchar(255) NULL',
			'email_ur_contact_check' => 'boolean NOT NULL default 1',
			'fio_parent' => 'varchar(255) NOT NULL',
			'fio_parent_check' => 'boolean NOT NULL default 1',
			'residence' => 'varchar(512) NOT NULL',
			'residence_check' => 'boolean NOT NULL default 1',
			'place_of_work' => 'varchar(512) NOT NULL',
			'place_of_work_check' => 'boolean NOT NULL default 1',
			'tel_parent' => 'varchar(11) NOT NULL',
			'tel_parent_check' => 'boolean NOT NULL default 1',
			'email_parent' => 'varchar(255) NOT NULL',
			'email_parent_check' => 'boolean NOT NULL default 1',
			'fio_child' => 'varchar(255) NOT NULL',
			'fio_child_check' => 'boolean NOT NULL default 1',
			'birthday_child' => 'date NOT NULL',
			'birthday_child_check' => 'boolean NOT NULL default 1',
			'place_of_study' => 'varchar(256) NOT NULL',
			'place_of_study_check' => 'boolean NOT NULL default 1',
			'status' => 'int(11) NOT NULL DEFAULT 0',
			'type' => 'boolean NOT NULL default 0',
		), 'ENGINE=InnoDB CHARSET=utf8');

	}

	public function down()
	{
		$this->dropTable('{{questionnaire}}');
	}

}