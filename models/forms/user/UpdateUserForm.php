<?php


namespace app\models\forms\user;


use app\models\Pegawai;
use app\models\User;
use Carbon\Carbon;
use InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\db\Exception;
use yii\web\UploadedFile;

class UpdateUserForm extends Model
{


    public $username;
    public $email;
    public $status;
    public $hak_akses;

    public $nama;
    public $nip;
    public $golongan;
    /** @var UploadedFile */
    public $avatar;



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
        $this->_pegawai = $this->_user->profilUser;

        $this->setAttributes([
            'username' => $this->_user->username,
            'email' => $this->_user->email,
            'status' => $this->_user->status,
            'nama' => $this->_pegawai->nama,
            
        ], false);

        $auth = Yii::$app->getAuthManager();
        $r = array_keys($auth->getRolesByUser($this->_user->id));
        $akses = array_combine($r, $r);
        $this->hak_akses = $akses;

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [

            [['username', 'email', 'status', 'hak_akses', 'nama','nip','golongan'], 'required'],
            [['username'],'unique','targetClass' => User::class, 'message' => '{attribute} "{value}" telah digunakan.'],
            [['email'],'unique','targetClass' => User::class,'message' => '{attribute} "{value}" telah digunakan.'],
            [['username', 'email', 'hak_akses', 'nama'], 'string'],
            ['golongan','integer'],
            ['avatar','file','skipOnEmpty' => true,'extensions' => ['jpg','png','jpeg','bmp']],
            [['avatar'], 'safe']
        ];
    }

    public function updateUser()
    {

        $user = $this->_user;

        $pegawai = $this->_pegawai;

        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
            'status' => $this->status,
        ], false);

        $pegawai->setAttributes(['nama' => $this->nama, 'nip' => $this->nip,
            '$this->golongan' => $this->golongan],false);

        if(!empty($this->avatar)){
            $timestamp = Carbon::now()->timestamp;

            $filename = "$timestamp".'-'.$this->avatar->getBaseName().'.'.$this->avatar->getExtension();
            $pegawai->avatar = $filename;
            $this->avatar->saveAs('@web/media/users'.$filename);
        }


        $transaction = \Yii::$app->db->beginTransaction();

        if (!$user->save()) {
            $transaction->rollBack();
            return false;
        }
        $pegawai->id_user = $user->id;
        if (!$pegawai->save()) {
            $transaction->rollBack();
            return false;
        }

        try {
            $auth = Yii::$app->getAuthManager();
            $r = array_values($auth->getRolesByUser($user->id));
            foreach ($r as $role) {
                $auth->revoke($role, $user->id);

            }
            $role = $auth->getRole($this->hak_akses);

            try {
                $auth->assign($role, $user->id);
            } catch (\Exception $e) {
                $transaction->rollBack();
                return false;
            }
            $transaction->commit();

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }


        return $user;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getProfilUser()
    {
        return $this->_pegawai;
    }
}