<?php

class m190211_174603_tel_fields extends CDbMigration
{
	public function up()
	{
        $this->alterColumn('{{questionnaire}}', 'tel_parent', 'varchar(20) NOT NULL');
        $this->alterColumn('{{questionnaire}}', 'tel_ur_contact', 'varchar(20) NOT NULL');


	}

	public function down()
	{
        $this->alterColumn('{{questionnaire}}', 'tel_parent', 'varchar(11) NOT NULL');
        $this->alterColumn('{{questionnaire}}', 'tel_ur_contact', 'varchar(11) NULL');
	}

}