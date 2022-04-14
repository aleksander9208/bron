<?php

class m190131_111759_q_add_fields extends CDbMigration
{
	public function up()
	{
		$this->addColumn('{{questionnaire}}', 'paid', 'boolean NOT NULL default 0');
		$this->addColumn('{{questionnaire}}', 'create_admin', 'boolean NOT NULL default 0');
		$this->addColumn('{{questionnaire}}', 'comment', 'text NULL');
	}

	public function down()
	{
		$this->dropColumn('{{questionnaire}}', 'paid');
		$this->dropColumn('{{questionnaire}}', 'create_admin');
		$this->dropColumn('{{questionnaire}}', 'comment');
	}
}