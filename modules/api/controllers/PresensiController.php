<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/10/2019
 * Time: 3:16 PM
 */

namespace app\modules\api\controllers;


use app\models\Presensi;
use app\models\PresensiKeluar;
use app\models\PresensiMasuk;
use Carbon\Carbon;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;

class PresensiController extends BaseController
{

    public function behaviors()
    {
        $parent = parent::behaviors();
        $parent['verbs'] = [
            'class' => VerbFilter::class,
            'actions' => [
                'datang' => ['POST'],
                'pulang' => ['POST']
            ]
        ];

        return $parent;
    }

    public function actionDatang()
    {
        $response = $this->getResponseFormat();
        $data = \Yii::$app->request->post();
        $tanggal = $data['tanggal'];
        $pegawai = $data['id_pegawai'];
        $waktu = $data['waktu'];
        if ($this->isActive($tanggal)) {
            $date = Carbon::parse($tanggal);
            $hari = $date->dayName;
            $presensi = $this->findModel($tanggal);
            $presensiDatang = PresensiMasuk::findOne(['id_presensi' => $presensi->id, 'id_pegawai' => $pegawai]);
            if ($presensiDatang->status === PresensiMasuk::DATANG) {
                $response['status'] = false;
                $response['message'] = 'Sudah melakukan presensi';
                return $response;
            }


            $hadir = $presensiDatang->hadir($hari, $waktu);
            $response['status'] = true;
            $response['message'] = 'Berhasil Mendaftarkan Presensi';
            $response['data'] = $hadir;
            return $response;
        }
        $response['status'] = false;
        $response['message'] = 'Presensi Tutup';
        return $response;
    }

    protected function isActive($date)
    {
        $model = $this->findModel($date);
        return $model->isBuka();
    }

    protected function findModel($date)
    {
        $model = Presensi::findOne(['tanggal' => $date]);
        if (!$model) {
            throw new NotFoundHttpException('Data yang anda cari tidak ditemukan');
        }
        return $model;
    }

    public function actionPulang()
    {
        $response = $this->getResponseFormat();
        $data = \Yii::$app->request->post();
        $tanggal = $data['tanggal'];
        $pegawai = $data['id_pegawai'];
        $waktu = $data['waktu'];
        if ($this->isActive($tanggal)) {
            $date = Carbon::parse($tanggal);
            $hari = $date->dayName;
            $presensi = $this->findModel($tanggal);
            $presensiPulang = PresensiKeluar::findOne(['id_presensi' => $presensi->id, 'id_pegawai' => $pegawai]);
            if ($presensiPulang->status === PresensiKeluar::PULANG) {
                $response['status'] = false;
                $response['message'] = 'Sudah melakukan presensi';
                return $response;
            }


            $hadir = $presensiPulang->pulang($hari, $waktu);
            $response['status'] = true;
            $response['message'] = 'Berhasil Mendaftarkan Presensi';
            $response['data'] = $hadir;
            return $response;
        }
        $response['status'] = false;
        $response['message'] = 'Presensi Tutup';
        return $response;
    }


}