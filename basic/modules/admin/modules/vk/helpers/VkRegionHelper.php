<?php
namespace app\modules\admin\modules\vk\helpers;

use Yii;

/**
 * Данный класс позволяет взаимодействоватть  и обрабатывать полученные данные из ВКонтакте для категории Регион.
 */
class VkRegionHelper
{
    /**
     * Отримання інформації про регіони що відносяться до певної країни  у вигляді відповідним чином відфільтрованого массиву
     *
     * @param $country - country_id
     *
     * @internal param $args
     *
     * @return array
     */
    public static function getCities( $country )
    {
        $args    = [
            'country_id' => '2',
            //'count'      => '',
        ];
        $i       = 0;
        $regions = [ ];
        $data              = new Vk( 'database.getRegions', $args );
        $data              = $data->fetchData();
        ///ddd($data);
        foreach ($data->response as $region) {
            $regions[$i][] = $region->region_id;
            $regions[$i][] = $region->title;
            $i ++;
        }

        return $regions;
    }
}