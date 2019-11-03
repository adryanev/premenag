<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/3/2019
 * Time: 7:28 PM
 */

namespace app\modules\api\controllers;


use app\models\Golongan;
use yii\rest\ActiveController;

class GolonganController extends ActiveController
{

    public $modelClass = Golongan::class;
}