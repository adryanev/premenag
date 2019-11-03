<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "koordinat".
 *
 * @property int $id
 * @property double $a_lat
 * @property double $a_lng
 * @property double $b_lat
 * @property double $b_lng
 * @property int $created_at
 * @property int $updated_at
 */
class Koordinat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'koordinat';
    }


    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['a_lat', 'a_lng', 'b_lat', 'b_lng'], 'number'],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'a_lat' => 'A Lat',
            'a_lng' => 'A Lng',
            'b_lat' => 'B Lat',
            'b_lng' => 'B Lng',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
