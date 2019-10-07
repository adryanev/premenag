<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "golongan".
 *
 * @property int $id
 * @property string $nama
 * @property int $tunjangan
 *
 * @property Pegawai[] $pegawais
 */
class Golongan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'golongan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tunjangan'], 'integer'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'tunjangan' => 'Tunjangan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['id_golongan' => 'id']);
    }
}
