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
        if ($this->isActive($data['tanggal'])) {
            $date = Carbon::parse($data['tanggal']);
            return $date->dayName;
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

    }
}