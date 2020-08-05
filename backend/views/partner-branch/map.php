<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PartnerBranchSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $yandexApiKey string */
/* @var array $metros */

$this->title = 'Филиалы на карте';
$this->params['breadcrumbs'][] = $this->title;

$mapStart = '55.751574, 37.573856';

$categoriesLicence = [];
$labels = '';
if ($dataProvider && $dataProvider->models) {
    foreach ($dataProvider->models as $key => $item) {
        $categoriesLicence[$item->category_id] = $item->category->category;

        if ($key == 0) {
            $mapStart = str_replace(' ', ',', $item->coor);
        }
        $labels .= '
        
        html = ' . $item->cost . '
        
        var iconColor = "#735184";
        
        var placemark = new ymaps.Placemark([' . str_replace(' ', ',', $item->coor) . '], {
            iconCaption: html,
            balloonContent: html + " руб."
        }, {
            preset: "islands#icon",
            iconColor: iconColor
        });
        
        if (typeof pvzCollection[' . $item->category_id . '] == "undefined") {
            pvzCollection[' . $item->category_id . '] = new ymaps.GeoObjectCollection();
        }
        
        pvzCollection[' . $item->category_id . '].add(placemark);
        ';
    }
}
?>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 search-map-panel">
    <?= Html::dropDownList('categories', null,
        \yii\helpers\ArrayHelper::merge([0 => 'Все категории'], $categoriesLicence),
        ['class' => 'form-control select']) ?>
    <?= Html::textInput('closest_address', '', ['class' => 'form-control input']) ?>
    <?= Html::button('Найти', ['class' => 'btn btn-primary', 'id' => 'seacrh-map-btn']) ?>
</div>
<br>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 map-wrapper">

    <div class="partner-branch-map">
        <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&amp;apikey=<?= $yandexApiKey ?>"
                type="text/javascript"></script>
        <script>
            ymaps.ready(function () {

                pvzCollection = {};

                var myMap = new ymaps.Map('map', {
                    center: [<?=$mapStart?>],
                    zoom: 9
                }, {
                    searchControlProvider: 'yandex#search'
                });

                <?php echo $labels; ?>

                $.each(pvzCollection, function (key, value) {
                    myMap.geoObjects.add(value);
                });

                $(document).on('change', 'select[name="categories"]', function () {
                    var cat = $(this).val();

                    if (cat == 0) {
                        $.each(pvzCollection, function (key, value) {
                            value.options.set('visible', true);
                        });
                        return;
                    }

                    $.each(pvzCollection, function (key, value) {
                        if (key != cat) {
                            value.options.set('visible', false);
                        } else {
                            value.options.set('visible', true);
                        }
                    });
                });

                $(document).on('click', '#seacrh-map-btn', function (e) {
                    address = $('input[name="closest_address"]').val();

                    if (address != '') {
                        ymaps.geocode(address, {
                            results: 1
                        }).then(function (res) {
                            console.dir(res);

                            var firstGeoObject = res.geoObjects.get(0),
                                // Координаты геообъекта.
                                coords = firstGeoObject.geometry.getCoordinates(),
                                // Область видимости геообъекта.
                                bounds = firstGeoObject.properties.get('boundedBy');

                            myMap.setCenter(coords, 14);
                        });
                    }
                });

                $(document).on('change', 'select[name="metros"]', function (e) {
                    var metrosId = $('select[name="metros"]').val();
                    var metrosName = $('select[name="metros"] option:selected').text();

                    if (metrosName != '') {
                        ymaps.geocode('метро ' + metrosName, {
                            results: 1
                        }).then(function (res) {
                            var firstGeoObject = res.geoObjects.get(0),
                                // Координаты геообъекта.
                                coords = firstGeoObject.geometry.getCoordinates(),
                                // Область видимости геообъекта.
                                bounds = firstGeoObject.properties.get('boundedBy');
                            myMap.setCenter(coords, 14);
                        });
                    }

                    $('.partner-branch-aside ol li').hide();

                    $.each($('.partner-branch-aside ol li'), function (index, value) {
                        var $li = $(this);
                        var metroData = $li.attr('data-metro');

                        if (metroData != '') {
                            var items = metroData.split(',');
                            $.each(items, function (index2, value2) {
                                if (value2 == metrosId) {
                                    $li.show();
                                }
                            });
                        }
                    });
                });
            });
        </script>

        <div id="map" style="height: 600px"></div>
    </div>

    <div class="partner-branch-aside">
        <?= Html::dropDownList('metros', null, \yii\helpers\ArrayHelper::merge([null => 'Подобрать по метро'], $metros),
            ['class' => 'form-control select-metros']) ?>
        <br>
        <div class="branches-wrapper">

            <?php if ($dataProvider && $dataProvider->models) : ?>
                <ol>
                    <?php foreach ($dataProvider->models as $key => $item) : ?>
                        <li data-metro="<?= $item->metro ?>"><?= $item->address ?></li>
                    <?php endforeach; ?>
                </ol>
            <?php endif ?>
        </div>
    </div>
</div>