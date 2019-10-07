<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $access_token
 * @property string $email
 * @property int $status
 * @property string $group
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Pegawai[] $pegawais
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['auth_key', 'password_hash', 'email'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username'], 'string', 'max' => 100],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'access_token', 'email', 'group'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'access_token' => 'Access Token',
            'email' => 'Email',
            'status' => 'Status',
            'group' => 'Group',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPegawais()
    {
        return $this->hasMany(Pegawai::className(), ['id_user' => 'id']);
    }
}
