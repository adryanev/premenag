<?php

namespace app\controllers;

use app\models\forms\koordinat\KoordinatForm;
use app\models\Koordinat;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * KoordinatController implements the CRUD actions for Koordinat model.
 */
class KoordinatController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'update', 'view', 'delete'],
                        'allow' => true,
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Koordinat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $koordinat = $this->findModel(1);
        $modelKoordinat = new KoordinatForm();
        $ne = [$koordinat->a_lat, $koordinat->a_lng];
        $sw = [$koordinat->b_lat, $koordinat->b_lng];
        $timurLaut = implode(',', $ne);
        $baratDaya = implode(',', $sw);
        $modelKoordinat->timurLaut = $timurLaut;
        $modelKoordinat->baratDaya = $baratDaya;

        if ($modelKoordinat->load(Yii::$app->request->post()) && $modelKoordinat->save()) {
            Yii::$app->session->setFlash('success', 'Berhasil mengubah Koordinat.');

            return $this->redirect(['koordinat/index']);
        }

        return $this->render('index', [
            'model' => $modelKoordinat,
            'koordinat' => $koordinat
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Koordinat::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
