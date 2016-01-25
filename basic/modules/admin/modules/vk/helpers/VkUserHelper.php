<?php
namespace app\modules\admin\modules\vk\helpers;

use Yii;
/**
 * Данный класс позволяет взаимодействоватть  и обрабатывать полученные данные из ВКонтакте для категории Пользователь.
 */
class VkUserHelper
{
    /**
     * Отримання інформації про одного користувача у вигляді відповідним чином відфільтрованого массиву
     *
     * @param $args
     *
     * @return array
     */
    public static function getUser( $args )
    {
        $data = new Vk( 'users.get', $args );

        $data = $data->fetchData();
        //ddd($data);
        $item = $data->response[0];
        //foreach ($data->response as $item) {
        $user[] = $item->uid;
        $user[] = $item->first_name;
        $user[] = $item->last_name;
        $user[] = $item->sex;
        $user[] = $item->bdate;
        $user[] = $item->city;

        $city_title = new Vk( 'database.getCitiesById', [ 'city_ids' => $item->city ] );
        $city_title = $city_title->fetchData();
        $city_title = $city_title->response[0]->name;
        $user[]     = $city_title;
        $user[]     = $item->country;
        $user[]     = $item->photo_200_orig;
        $user[]     = $item->domain;
        $user[]     = $item->schools['0']->id;
        $user[]     = $item->schools['0']->city;
        $user[]     = $item->schools['0']->name;
        if (isset( $item->schools['0']->year_to )) {
            $user[] = $item->schools['0']->year_to;
        } else {
            $user[] = $item->schools['0']->year_graduated;}
        $user[] = $item->last_seen->time;
        $user[] = $item->can_post;
        $user[] = $item->can_write_private_message;
        $user[] = '';
        $user[] = 1;
        $user[] = time();
        $user[] = time();
        return $user;
    }

    /**
 * Отримання інформації про користувачів із массиву ІД, який задається
 *
 * @param $user_ids
 *
 * @return array
 */
    public static function getUsers( $user_ids )
    {
        $args = [
            //'user_id' => '',
            'fields'  => 'sex,
                bdate,
                city,
                country,
                photo_200_orig,
                domain,
                schools,
                last_seen,
                can_post,
                can_write_private_message',
        ];

        $users = [ ];
        $i     = 0;
        foreach ($user_ids as $id) {
            $args['user_id'] = $id;
            $users[$i]       = self::getUser( $args );
            $i ++;
        }
        return $users;
    }

    /**
     * Пошук інформації про користувачів
     *
     * @return array
     */
    public static function searchUsers( )
    {
        $args = [
            'user_id' => '',
            'fields'  => 'sex,
                bdate,
                city,
                country,
                photo_200_orig,
                domain,
                schools,
                last_seen,
                can_post,
                can_write_private_message',
        ];

        $users = [ ];
        $i     = 0;
        foreach ($user_ids as $id) {
            $args['user_id'] = $id;
            $users[$i]       = self::getUser( $args );
            $i ++;
        }
        return $users;
    }
}