<?php


namespace app\models\forms\user;


use app\models\Pegawai;
use app\models\User;
use Carbon\Carbon;
use InvalidArgumentException;
use Yii;
use yii\base\Model;
use yii\bootstrap\ActiveForm;
use yii\db\Exception;
use yii\web\UploadedFile;

class CreateUserForm extends Model
{

    public $username;
    public $password;
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
    private $_pegawaiUser;

    public function attributeLabels()
    {
        return [
            'username' => 'Username',
        ];
    }

    public function rules()
    {
        return [

            [['username', 'password', 'email', 'status', 'hak_akses', 'nama','nip','golongan'], 'required'],
            [['username'],'unique','targetClass' => User::class, 'message' => '{attribute} "{value}" telah digunakan.'],
            [['email'],'unique','targetClass' => User::class,'message' => '{attribute} "{value}" telah digunakan.'],
            [['username', 'password', 'email', 'hak_akses', 'nama','nip'], 'string'],
            ['golongan','integer'],
            ['avatar','file','skipOnEmpty' => true,'extensions' => ['jpg','png','jpeg','bmp']],
            [['avatar'], 'safe']
        ];
    }

    public function addUser()
    {
        $user = new User();
        $pegawai = new Pegawai();
        $user->setAttributes(['username' => $this->username,
            'email' => $this->email,
            'status' => $this->status,
        ]);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $pegawai->setAttributes([
            'nama' => $this->nama,
            'nip' => $this->nip,
            '$this->golongan' => $this->golongan], false);

        if(!empty($this->avatar)){
            $timestamp = Carbon::now()->timestamp;

            $filename = "$timestamp".'-'.$this->avatar->getBaseName().'.'.$this->avatar->getExtension();
            $pegawai->avatar = $filename;
            $this->avatar->saveAs('@web/media/users'.$filename);
        }


        $transaction = Yii::$app->db->beginTransaction();


        if (!$user->save(false)) {
            $transaction->rollBack();
            return null;
        }
        $pegawai->id_user = $user->id;
        if (!$pegawai->save(false)) {
            $transaction->rollBack();
            return null;
        }


        try {

            $auth = Yii::$app->getAuthManager();
            $role = $auth->getRole($this->hak_akses);

            try {
                $auth->assign($role, $user->id);
            } catch (\Exception $e) {
                $transaction->rollBack();
                return null;
            }

            $transaction->commit();
            return $user;

        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
        return null;
    }

}