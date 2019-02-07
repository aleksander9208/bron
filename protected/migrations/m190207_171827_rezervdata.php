<?php

class m190207_171827_rezervdata extends CDbMigration
{
	public function up()
	{
        $this->insert('{{questionnaire_rezerv}}', array(
            'id' => 1,
            'srez_1' => 0,
            'srez_2' => 0,
            'srez_3' => 0,
            'srez_4' => 0,
            'srez_5' => 0,
            'srez_6' => 0,
            'srez_7' => 0,
            'srez_8' => 0,
            'srez_9' => 0,
            'srez_10' => 0,
            'srez_11' => 0,
            'srez_12' => 0,
            'srez_13' => 0,
            'srez_14' => 0,
            'srez_15' => 0,
            'srez_16' => 0,
            'srez_17' => 0,
            'srez_18' => 0,
            'srez_19' => 0,
            'srez_20' => 0,
            'srez_21' => 0,
            'srez_22' => 0,
            'srez_23' => 0,
            'srez_24' => 0,
            'srez_25' => 0,
            'srez_26' => 0,
            'srez_27' => 0,
        ));
        $this->addColumn('{{questionnaire}}', 'camp_id', 'int(11) not null DEFAULT 0');
	}

	public function down()
	{
        $this->dropColumn('{{questionnaire}}', 'camp_id');
        $this->delete('{{questionnaire_rezerv}}', 'id=1');
	}

}