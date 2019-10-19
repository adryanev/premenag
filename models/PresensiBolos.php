<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "presensi_bolos".
 *
 * @property int $id
 * @property int $id_presensi
 * @property int $id_pegawai
 * @property string $waktu
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Pegawai $pegawai
 * @property Presensi $presensi
 */
class PresensiBolos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi_bolos';
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
            [['id_presensi', 'id_pegawai', 'created_at', 'updated_at'], 'integer'],
            [['waktu'], 'safe'],
            [['id_pegawai'], 'exist', 'skipOnError' => true, 'targetClass' => Pegawai::className(), 'targetAttribute' => ['id_pegawai' => 'id']],
            [['id_presensi'], 'exist', 'skipOnError' => true, 'targetClass' => Presensi::className(), 'targetAttribute' => ['id_presensi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_presensi' => 'Id Presensi',
            'id_pegawai' => 'Id Pegawai',
            'waktu' => 'Waktu',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id' => 'id_pegawai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensi()
    {
        return $this->hasOne(Presensi::className(), ['id' => 'id_presensi']);
    }
}
