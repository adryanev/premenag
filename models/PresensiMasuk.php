<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "presensi_masuk".
 *
 * @property int $id
 * @property int $id_presensi
 * @property int $id_pegawai
 * @property string $jam_masuk
 * @property string $telat_masuk
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Pegawai $pegawai
 * @property Presensi $presensi
 */
class PresensiMasuk extends \yii\db\ActiveRecord
{
    const DATANG = 1;
    const TIDAK_DATANG = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi_masuk';
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
            [['id_presensi', 'id_pegawai', 'status', 'created_at', 'updated_at'], 'integer'],
            [['jam_masuk', 'telat_masuk'], 'safe'],
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
            'jam_masuk' => 'Jam Masuk',
            'telat_masuk' => 'Telat Masuk',
            'status' => 'Status',
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

    public function isTerlambat($hari, $jamDatang)
    {
        $jam = 0;

        switch ($hari) {
            case 'Senin':
            case 'Selasa':
            case 'Rabu':
            case 'Kamis':
                $jam = ArrayHelper::getValue(\Yii::$app->params['waktu'], 'All.datang');
                break;
            case 'Jumat':
                $jam = ArrayHelper::getValue(\Yii::$app->params['waktu'], 'Jumat.datang');
                break;
        }

        return $jam < $jamDatang;

    }
}
