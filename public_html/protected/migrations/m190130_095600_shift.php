<?php

class m190130_095600_shift extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{questionnaire}}', 'shift_id', 'int(11) not null DEFAULT 0');
		$this->addColumn('{{questionnaire}}', 'dlo_id', 'int(11) not null DEFAULT 0');
		$this->addColumn('{{questionnaire}}', 'is_main', 'boolean NOT NULL default 0');
	}

	public function down()
	{
		$this->dropColumn('{{questionnaire}}', 'shift_id');
		$this->dropColumn('{{questionnaire}}', 'dlo_id');
		$this->dropColumn('{{questionnaire}}', 'is_main');
	}

}