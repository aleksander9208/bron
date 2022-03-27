<?php

class m190207_141409_rezerv extends CDbMigration
{
	public function up()
	{

		$this->createTable('{{questionnaire_rezerv}}', array(
			'id' => 'pk',
			'srez_1' => 'int(11) NOT NULL DEFAULT 0',
			'srez_2' => 'int(11) NOT NULL DEFAULT 0',
			'srez_3' => 'int(11) NOT NULL DEFAULT 0',
			'srez_4' => 'int(11) NOT NULL DEFAULT 0',
			'srez_5' => 'int(11) NOT NULL DEFAULT 0',
			'srez_6' => 'int(11) NOT NULL DEFAULT 0',
			'srez_7' => 'int(11) NOT NULL DEFAULT 0',
			'srez_8' => 'int(11) NOT NULL DEFAULT 0',
			'srez_9' => 'int(11) NOT NULL DEFAULT 0',
			'srez_10' => 'int(11) NOT NULL DEFAULT 0',
			'srez_11' => 'int(11) NOT NULL DEFAULT 0',
			'srez_12' => 'int(11) NOT NULL DEFAULT 0',
			'srez_13' => 'int(11) NOT NULL DEFAULT 0',
			'srez_14' => 'int(11) NOT NULL DEFAULT 0',
			'srez_15' => 'int(11) NOT NULL DEFAULT 0',
			'srez_16' => 'int(11) NOT NULL DEFAULT 0',
			'srez_17' => 'int(11) NOT NULL DEFAULT 0',
			'srez_18' => 'int(11) NOT NULL DEFAULT 0',
			'srez_19' => 'int(11) NOT NULL DEFAULT 0',
			'srez_20' => 'int(11) NOT NULL DEFAULT 0',
			'srez_21' => 'int(11) NOT NULL DEFAULT 0',
			'srez_22' => 'int(11) NOT NULL DEFAULT 0',
			'srez_23' => 'int(11) NOT NULL DEFAULT 0',
			'srez_24' => 'int(11) NOT NULL DEFAULT 0',
			'srez_25' => 'int(11) NOT NULL DEFAULT 0',
			'srez_26' => 'int(11) NOT NULL DEFAULT 0',
			'srez_27' => 'int(11) NOT NULL DEFAULT 0',
		), 'ENGINE=InnoDB CHARSET=utf8');
	}

	public function down()
	{
		$this->dropTable('{{questionnaire_rezerv}}');
	}

}