<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/3/2019
 * Time: 7:59 PM
 */

namespace app\modules\api\controllers;


use app\models\Pegawai;
use yii\rest\ActiveController;
use yii\rest\Serializer;

class PegawaiController extends ActiveController
{

    public $modelClass = Pegawai::class;
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items'
    ];
}