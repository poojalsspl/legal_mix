<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

class AdvSearch extends ActiveRecord
{
    public  $search;

    public function getTreeForCourts(){
        $data = [];
        $sql = 'SELECT * FROM court_group_mast';
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $courtrecords = $command->queryAll();

        foreach($courtrecords as $record){
            $data[$record['court_group_code']]['header'] = $record['court_group_name'];
            $data[$record['court_group_code']]['id'] = $record['court_group_code'];
        }

        $sql = 'SELECT * FROM court_type_mast';
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $courtrecords = $command->queryAll();

        foreach($courtrecords as $record){
            $data[$record['court_group_code']]['items'][$record['court_type']]['header'] = $record['court_type_desc'];
            $data[$record['court_group_code']]['items'][$record['court_type']]['id'] = $record['court_type'];
        }
        $sql = 'SELECT * FROM court_mast_hedr ORDER BY court_name';
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand($sql);
        $courtrecords = $command->queryAll();

        foreach($courtrecords as $record){
            $data[$record['court_group_code']]['items'][$record['court_type']]['items'][$record['court_code']]['header'] = $record['court_name'];
            $data[$record['court_group_code']]['items'][$record['court_type']]['items'][$record['court_code']]['id'] = $record['court_code'];
        }

        return $data;
    }
}
