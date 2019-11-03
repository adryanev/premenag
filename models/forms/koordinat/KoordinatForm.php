<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/3/2019
 * Time: 6:13 PM
 */

namespace app\models\forms\koordinat;


use app\models\Koordinat;
use yii\base\Model;
use yii\helpers\StringHelper;

class KoordinatForm extends Model
{

    public $timurLaut;
    public $baratDaya;

    public function rules()
    {
        return [
            [['timurLaut', 'baratDaya'], 'required'],
            [['baratDaya', 'timurLaut'], 'string']
        ];
    }


    public function save()
    {
        $northEast = $this->getLatLng($this->timurLaut);
        $southWest = $this->getLatLng($this->baratDaya);

        $model = Koordinat::findOne(1);
        $model->a_lat = $northEast[0];
        $model->a_lng = $northEast[1];
        $model->b_lat = $southWest[0];
        $model->b_lng = $southWest[1];

        return $model->save(false) ? $model : false;
    }

    private function getLatLng($kordinat)
    {
        $latLng = StringHelper::explode($kordinat);
        return $latLng;
    }
}