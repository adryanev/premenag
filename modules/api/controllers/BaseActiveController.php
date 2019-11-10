<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/10/2019
 * Time: 2:12 PM
 */

namespace app\modules\api\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\ActiveController;
use yii\rest\Serializer;

class BaseActiveController extends ActiveController
{

    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'authMethods' => [
                HttpBasicAuth::className(),
                HttpBearerAuth::className(),
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;

    }
}