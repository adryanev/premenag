<?php

namespace app\modules\api;

use Carbon\Carbon;

/**
 * api module definition class
 */
class Api extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        \Yii::$app->setComponents(require __DIR__ . '/config/api.php');
        Carbon::setLocale('id');


        // custom initialization code goes here
    }
}
