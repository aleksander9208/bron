<?php

class m190130_075336_alter_fields extends CDbMigration
{
	public function up()
	{
		$this->alterColumn('{{questionnaire}}', 'name_ur_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'fio_ur_contact_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'tel_ur_contact_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'email_ur_contact_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'fio_parent_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'residence_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'place_of_work_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'tel_parent_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'email_parent_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'fio_child_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'birthday_child_check', 'boolean NOT NULL default 0');
		$this->alterColumn('{{questionnaire}}', 'place_of_study_check', 'boolean NOT NULL default 0');
	}

	public function down()
	{
		$this->alterColumn('{{questionnaire}}', 'name_ur_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'fio_ur_contact_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'tel_ur_contact_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'email_ur_contact_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'fio_parent_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'residence_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'place_of_work_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'tel_parent_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'email_parent_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'fio_child_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'birthday_child_check', 'boolean NOT NULL default 1');
		$this->alterColumn('{{questionnaire}}', 'place_of_study_check', 'boolean NOT NULL default 1');
	}

}