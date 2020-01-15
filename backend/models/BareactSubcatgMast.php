<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "bareact_subcatg_mast".
 *
 * @property int $act_sub_catg_code
 * @property string $act_sub_catg_desc
 * @property string $short_desc
 * @property int $act_catg_code
 * @property string $act_catg_desc
 * @property int $act_group_code
 * @property string $act_group_desc
 * @property int $country_code
 * @property string $country_name
 */
class BareactSubcatgMast extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bareact_subcatg_mast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['act_sub_catg_code', 'act_catg_code', 'act_group_code', 'country_code'], 'integer'],
            [['act_sub_catg_desc', 'act_catg_desc'], 'string', 'max' => 100],
            [['short_desc'], 'string', 'max' => 15],
            [['act_group_desc', 'country_name'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'act_sub_catg_code' => 'Act Sub Catg Code',
            'act_sub_catg_desc' => 'Act Sub Catg Desc',
            'short_desc' => 'Short Desc',
            'act_catg_code' => 'Act Catg Code',
            'act_catg_desc' => 'Act Catg Desc',
            'act_group_code' => 'Act Group Code',
            'act_group_desc' => 'Act Group Desc',
            'country_code' => 'Country Code',
            'country_name' => 'Country Name',
        ];
    }

    /*public function getSubcatglist($act_catg_code){

     $query = (new \yii\db\Query())
        ->select('act_sub_catg_code ,act_sub_catg_desc')
        ->from('bareact_subcatg_mast')
        ->where('act_catg_code=:act_catg_code', [':act_catg_code' => $act_catg_code])
        ->orderBy('act_sub_catg_desc');
        
        $command = $query->createCommand();
        $rows[] = $command->queryAll();
        $row = $rows[];
        if($row){
        return $row;
    }       
    }*/

    public function getBareactCode($act_code){
        $model = BareactSubcatgMast::find()
           ->select('act_sub_catg_desc,act_sub_catg_code')
           ->where(['act_catg_code' => $act_code])
           ->orderBy('act_sub_catg_desc')
           ->all();
          return $model;
    }


}
