<?php
namespace app\modules\admin\modules\vk\helpers;

use Yii;
/**
 * Данный класс позволяет взаимодействоватть  и обрабатывать полученные данные из ВКонтакте для категории Школа.
 */
class VkSchoolHelper
{
    /**
     * Отримання інформації про школи що відносяться до певного міста  у вигляді відповідним чином відфільтрованого массиву
     *
     * @param $cities
     *
     * @internal param $args
     *
     * @return array
     */
    public static function getSchools( $cities )
    {
        $args = [
            'city_id' => '',
            //'count'  => '10',
        ];
        $i = 0;
        $schools = [];
        foreach($cities as $city){
            $args['city_id'] = $city;
            $data = new Vk( 'database.getSchools', $args );
            $data = $data->fetchData();
            //ddd($data);
            foreach($data->response as $school){
                if(is_numeric($school))  continue;
                if((strpos($school->title, 'шк.') === false) )  continue;
                $schools[$i][] = $school->id;
                $schools[$i][] = $school->title;
                $schools[$i][] = $city;
                $i++;
            }
        }
        return $schools;
    }
}