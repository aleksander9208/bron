<?php


class Camp extends CActiveRecord
{
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return '{{camp}}';
    }

    public function rules()
    {
        return array(

        );
    }
}