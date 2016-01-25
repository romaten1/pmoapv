<?php
namespace app\modules\admin\modules\vk\helpers;

use Yii;
/**
 * Данный класс позволяет взаимодействоватть  и обрабатывать полученные данные из ВКонтакте для категории Город.
 */
class VkCityHelper
{
    /**
     * Отримання інформації про міста що відносяться до певного регіону  у вигляді відповідним чином відфільтрованого массиву
     *
     * @param $regions - array of region_id
     *
     * @internal param $args
     *
     * @return array
     */
    public static function getCities( $regions )
    {
        $args = [
            'country_id' => '2',
            'region_id' => '',
            'count'  => '1000',
        ];
        $i = 0;
        $cities = [];
        foreach($regions as $region){
            $args['region_id'] = $region;
            $data = new Vk( 'database.getCities', $args );
            $data = $data->fetchData();
            //ddd($data);
            foreach($data->response as $city){
                $cities[$i][] = $city->cid;
                $cities[$i][] = $city->title;
                $cities[$i][] = $city->area;
                $cities[$i][] = $city->region;
                $i++;
            }
        }
        return $cities;
    }
}