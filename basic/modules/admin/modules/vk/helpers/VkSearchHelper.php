<?php
namespace app\modules\admin\modules\vk\helpers;

use Yii;
/**
 * Данный класс позволяет взаимодействоватть  и обрабатывать полученные данные из ВКонтакте для категории Школа.
 */
class VkSearchHelper
{
    /**
     * ПОшук
     *
     * @param $schools
     *
     * @internal param $cities
     *
     * @internal param $args
     *
     * @return array
     */
    public static function getSearch( $schools )
    {
        $args = [
            'school_year' => '2015',
            'access_token' => '6b7e99afa9a44d0871aab62f6187bb954aba13c1210ba4bcf804baf96def53a66e3effabbe1587147d70c',
            'count'  => '1000',
        ];

        $users = [];
        foreach($schools as $school){
            $args['school'] = $school['school_id'];
            $args['city'] = $school['city_id'];
            $data = new Vk( 'users.search', $args );
            $data = $data->fetchData();
            ///ddd($data);
            foreach($data->response as $user){
                if(is_numeric($user))  continue;
                if(is_null($user))  continue;
                //if((strpos($user->title, 'шк.') === false) )  continue;
                $users[] = $user->uid;
                //$users[$i][] = $school->title;

            }
        }
        return $users;
    }
}
