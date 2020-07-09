<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PartnerBranchSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $yandexApiKey string */

$this->title = 'Филиалы на карте';
$this->params['breadcrumbs'][] = $this->title;

$mapStart = '55.751574, 37.573856';

$labels = '';
if ($dataProvider && $dataProvider->models) {
    foreach ($dataProvider->models as $key => $item) {
        if ($key == 0) {
            $mapStart = str_replace(' ', ',', $item->coor);
        }
        $labels .= '
        myGeoObject' . $key . ' = new ymaps.GeoObject({
            geometry: {
                type: "Point",
                coordinates: [' . str_replace(' ', ',', $item->coor) . ']
            },
            properties: {
                // Контент метки.
                iconContent: "' . $item->address . '"
            }
        }, {
            preset: "islands#icon"
        });
        myMap.geoObjects.add(myGeoObject' . $key . ');
        ';
    }
}

?>
<div class="partner-branch-map">

    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<?= $yandexApiKey ?>"
            type="text/javascript"></script>
    <script>
        ymaps.ready(function () {
            var myMap = new ymaps.Map('map', {
                center: [<?=$mapStart?>],
                zoom: 9
            }, {
                searchControlProvider: 'yandex#search'
            });

            <?php echo $labels; ?>
        });
    </script>

    <div id="map" style="width: 70%; height: 600px"></div>
</div>
