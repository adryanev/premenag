<?php

use app\models\forms\koordinat\KoordinatForm;
use app\models\Koordinat;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\LatLngBounds;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Rectangle;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $koordinat Koordinat */
/* @var $model KoordinatForm */

$this->title = 'Koordinat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-lg-12">

        <!--begin::Portlet-->
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <span class="kt-portlet__head-icon">
                        <i class="flaticon2-list-2"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        <?= Html::encode($this->title) ?> <small>Lokasi
                            Kantor <?= Yii::$app->params['instansi'] ?></small>
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <div class="koordinat-index">

                    <div class="row">
                        <div class="col-lg-6">
                            <?php
                            $coord = new LatLng(['lat' => $koordinat->a_lat, 'lng' => $koordinat->a_lng]);

                            $map = new Map([
                                'center' => $coord,
                                'zoom' => 17,

                            ]);
                            $map->width = '100%';

                            // create rectangle
                            $bounds = new LatLngBounds([
                                'northEast' => new LatLng(['lat' => $koordinat->a_lat, 'lng' => $koordinat->a_lng]),
                                'southWest' => new LatLng(['lat' => $koordinat->b_lat, 'lng' => $koordinat->b_lng]),

                            ]);

                            $rectangle = new Rectangle([
                                'bounds' => $bounds, // here my bounds!
                                'draggable' => true,
                                'editable' => true,
                            ]);


                            $map->addOverlay($rectangle);
                            $rectangleEvent = <<<JS
                            grectangle1.addListener('bounds_changed',function(){
                                
                              var ne = grectangle1.getBounds().getNorthEast();
        var sw = grectangle1.getBounds().getSouthWest();

        var timurLaut = document.getElementById('timurLaut');
        var baratDaya = document.getElementById('baratDaya');
        
        timurLaut.value = ne.lat()+','+ne.lng();
        baratDaya.value = sw.lat()+','+sw.lng();
        
                            });
JS;

                            $map->appendScript($rectangleEvent);

                            echo $map->display();

                            ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $this->render('_form', ['model' => $model]) ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--end::Portlet-->

    </div>
</div>



