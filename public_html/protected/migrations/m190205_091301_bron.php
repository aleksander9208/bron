<?php

class m190205_091301_bron extends CDbMigration
{
    public function up()
    {
        $this->addColumn('{{questionnaire}}', 'booking_id', 'varchar(16) NULL');
    }

    public function down()
    {
        $this->dropColumn('{{questionnaire}}', 'booking_id');
    }

}