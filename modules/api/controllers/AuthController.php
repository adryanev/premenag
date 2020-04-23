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
            $user = $model->getUser();
            $user->generateAccessToken();
            $user->update(false);
            $profil = $user->pegawai;
            $response['status'] = 200;
            $response['message'] = 'Success';
            $response['data']['user'] = $user;
            $response['data']['pegawai'] = $profil;
        } else {
            $response['status'] = 401;
            $response['message'] = 'Unauthorized';
        }
        return $response;

    }


    public function actionLogout()
    {
        $response = $this->getResponseFormat();
        $user = \Yii::$app->user->identity;
        $user->access_token = null;
        $user->save(false);
        \Yii::$app->user->logout();

        $response['status'] = 200;
        $response['message'] = 'Success';

        return $response;

    }
}