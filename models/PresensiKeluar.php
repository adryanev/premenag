<?php

namespace app\models;

use Carbon\Carbon;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "presensi_keluar".
 *
 * @property int $id
 * @property int $id_presensi
 * @property int $id_pegawai
 * @property string $jam_pulang
 * @property int $duluan_keluar
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Pegawai $pegawai
 * @property Presensi $presensi
 */
class PresensiKeluar extends \yii\db\ActiveRecord
{
    const PULANG = 1;
    const BELUM_PULANG = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'presensi_keluar';
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
            [['id_presensi', 'id_pegawai', 'status', 'created_at', 'updated_at', 'duluan_keluar'], 'integer'],
            [['jam_pulang', 'duluan_keluar'], 'safe'],
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
            'jam_pulang' => 'Jam Pulang',
            'duluan_keluar' => 'Duluan Keluar',
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

    public function pulang($hari, $jamPulang)
    {

        $terlambat = $this->isDuluan($hari, $jamPulang);
        $this->jam_pulang = $jamPulang;
        $this->status = self::PULANG;
        $this->save(false);

        return $this;
    }

    private function isDuluan($hari, $jamPulang)
    {

        return $this->hitungDuluan($hari, $jamPulang) > 0;

    }

    private function hitungDuluan($hari, $jamPulang)
    {
        $waktuPeraturan = '';


        switch ($hari) {
            case 'Senin':
            case 'Selasa':
            case 'Rabu':
            case 'Kamis':
                $waktuPeraturan = ArrayHelper::getValue(\Yii::$app->params['waktu'], 'All.pulang');
                break;
            case 'Jumat':
                $waktuPeraturan = ArrayHelper::getValue(\Yii::$app->params['waktu'], 'Jumat.pulang');
                break;
        }

        $waktuPeraturanParse = Carbon::parse($waktuPeraturan);
        $waktuParse = Carbon::parse($jamPulang);
        $diff = $waktuPeraturanParse->diffinMinutes($waktuParse, false);
        $this->duluan_keluar = $diff;
        return $diff;

    }
}
