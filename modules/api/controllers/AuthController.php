<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/3/2019
 * Time: 7:56 PM
 */

namespace app\modules\api\controllers;


use app\models\LoginForm;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;

class AuthController extends BaseController
{

    public function behaviors()
    {
        return [
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    HttpBasicAuth::className(),
                    HttpBearerAuth::className(),
                    QueryParamAuth::className(),
                ],
                'only' => ['logout']
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::className(),
                'actions' => [
                    'login' => ['POST'],
                    'logout' => ['POST'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {

        $response = $this->getResponseFormat();
        $model = new LoginForm();
        if ($model->load(\Yii::$app->request->post(), '') && $model->login()) {
            $model->getUser()->generateAccessToken();
            $model->getUser()->save(false);
            $response['status'] = true;
            $response['message'] = 'Berhasil Login';
            $response['data'] = $model->getUser();
            return $response;
        }
        $model->validate();
        return $model;

    }


    public function actionLogout()
    {
        $response = $this->getResponseFormat();
        $user = \Yii::$app->user->identity;
        $user->access_token = null;
        $user->save(false);
        \Yii::$app->user->logout();

        $response['status'] = true;
        $response['message'] = 'Berhasil Logout';

        return $response;

    }
}