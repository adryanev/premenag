<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pegawai".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_golongan
 * @property string $nip
 * @property string $nama
 * @property string $jabatan
 * @property string $avatar
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Golongan $golongan
 * @property User $user
 */
class Pegawai extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pegawai';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_golongan', 'created_at', 'updated_at'], 'integer'],
            [['nip', 'nama', 'jabatan', 'avatar'], 'string', 'max' => 255],
            [['id_golongan'], 'exist', 'skipOnError' => true, 'targetClass' => Golongan::className(), 'targetAttribute' => ['id_golongan' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_golongan' => 'Id Golongan',
            'nip' => 'Nip',
            'nama' => 'Nama',
            'jabatan' => 'Jabatan',
            'avatar' => 'Avatar',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGolongan()
    {
        return $this->hasOne(Golongan::className(), ['id' => 'id_golongan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
