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

class PegawaiController extends BaseActiveController
{
    public $modelClass = Pegawai::class;
}