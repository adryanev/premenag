<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/10/2019
 * Time: 3:21 PM
 */

namespace app\commands;


use app\models\Pegawai;
use app\models\Presensi;
use app\models\PresensiKeluar;
use app\models\PresensiMasuk;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\web\NotFoundHttpException;

class PresensiController extends Controller
{

    public function actionBuat($date)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        $model = new Presensi();
        $model->tanggal = $date;
        $model->status = Presensi::TUTUP;
        $model->save(false);

        $pegawais = Pegawai::find()->all();
        foreach ($pegawais as $pegawai) {
            $modelPresensiMasuk = new PresensiMasuk();
            $modelPresensiMasuk->id_presensi = $model->id;
            $modelPresensiMasuk->id_pegawai = $pegawai->id;
            $modelPresensiMasuk->status = PresensiMasuk::TIDAK_DATANG;
            $modelPresensiMasuk->save(false);

            $modelPresensiKeluar = new PresensiKeluar();

        }
        return ExitCode::OK;
    }

    public function actionBuka($date)
    {
        $model = $this->findModel($date);
        $model->status = Presensi::BUKA;
        $model->save(false);
        return ExitCode::OK;
    }

    protected function findModel($date)
    {
        $model = Presensi::findOne(['tanggal' => $date]);
        if (!$model) {
            throw new NotFoundHttpException('Data tidak ditemukan');
        }
        return $model;
    }

    public function actionTutup($date)
    {
        $model = $this->findModel($date);
        $model->status = Presensi::TUTUP;
        $model->save(false);
        return ExitCode::OK;
    }
}