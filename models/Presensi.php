<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "presensi".
 *
 * @property int $id
 * @property string $tanggal
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property PresensiBolos[] $presensiBolos
 * @property PresensiKeluar[] $presensiKeluars
 * @property PresensiMasuk[] $presensiMasuks
 */
class Presensi extends \yii\db\ActiveRecord
{

    const BUKA = 1;
    const TUTUP = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi';
    }

    public function isBuka()
    {
        return $this->status === self::BUKA;
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
            [['tanggal'], 'safe'],
            [['status', 'created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensiBolos()
    {
        return $this->hasMany(PresensiBolos::className(), ['id_presensi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensiKeluars()
    {
        return $this->hasMany(PresensiKeluar::className(), ['id_presensi' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPresensiMasuks()
    {
        return $this->hasMany(PresensiMasuk::className(), ['id_presensi' => 'id']);
    }
}
