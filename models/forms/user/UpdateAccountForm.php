<?php

namespace app\models\forms\user;

use app\models\Pegawai;
use app\models\User;
use InvalidArgumentException;
use Yii;
use yii\db\Exception;

class UpdateAccountForm extends \yii\base\Model
{
    public $username;
    public $email;
    public $nama;


    /**
     * @var User
     */
    private $_user;

    /**
     * @var Pegawai
     */
    private $_pegawai;

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
        ];
    }

    public function __construct($id, $config = [])
    {

        if (empty($id)) {
            throw new InvalidArgumentException('Id tidak boleh kosong');
        }
        $this->_user = User::findOne($id);
        if (!$this->_user) {
            throw new InvalidArgumentException('User tidak Ditemukan');
        }
        $this->_pegawai = $this->_user->pegawai;

        $this->setAttributes([
            'username' => $this->_user->username,
            'email' => $this->_user->email,
            'nama' => $this->_pegawai->nama,
        ], false);


        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['username', 'email', 'nama'], 'required'],
        ];
    }

    public function updateUser()
    {

        $user = $this->_user;
        $profil = $this->_pegawai;

        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
        ]);

        $profil->setAttributes(['nama' => $this->nama]);

        $transaction = \Yii::$app->db->beginTransaction();


        try {
            if (!$user->save(false)) {
                $transaction->rollBack();
                return false;
            }
            $profil->id_user = $user->id;
            if (!$profil->save(false)) {
                $transaction->rollBack();
                return false;
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            return false;
        }


        return $user;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getPegawai()
    {
        return $this->_pegawai;
    }
}