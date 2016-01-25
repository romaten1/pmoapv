<?php

namespace app\modules\admin\modules\vk\controllers;

use app\modules\admin\modules\vk\helpers\Vk;
use app\modules\admin\modules\vk\helpers\VkCityHelper;
use app\modules\admin\modules\vk\helpers\VkRegionHelper;
use app\modules\admin\modules\vk\helpers\VkSchoolHelper;
use app\modules\admin\modules\vk\helpers\VkSearchHelper;
use app\modules\admin\modules\vk\helpers\VkUserHelper;
use app\modules\admin\modules\vk\models\VkCity;
use app\modules\admin\modules\vk\models\VkSchool;
use app\modules\admin\modules\vk\models\VkUser;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Controller;

/**
 * BestStudentController implements the CRUD actions for BestStudent model.
 */
class VkController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['admin', 'create', 'update', 'delete'], //only be applied to
                'rules' => [
                    [
                        'allow'   => true,
                        'actions' => [ 'get-users', 'get-cities', 'get-regions', 'get-schools', 'get-search' ],
                        'roles'   => [ 'admin' ],
                    ]
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => [ 'post' ],
                ],
            ],
        ];
    }

    public function actionGetUsers()
    {
        $user_ids = [
            '198058365',
        ];
        $users    = VkUserHelper::getUsers( $user_ids );
        Yii::$app->db->createCommand()->batchInsert( 'vk_user',
            [
                'user_id',
                'first_name',
                'last_name',
                'sex',
                'bdate',
                'city_id',
                'city_title',
                'country',
                'photo_200_orig',
                'domain',
                'school_id',
                'school_city_id',
                'school_name',
                'school_year_to',
                'last_seen',
                'can_post',
                'can_write_private_message',
                'description',
                'active',
                'created_at',
                'updated_at',
            ],
            $users )->execute();
        return $this->redirect( [ '/admin' ] );

    }

    public function actionGetCities()
    {
        $region_ids = [
            '1513930',
        ];
        $cities     = VkCityHelper::getCities( $region_ids );
        //ddd($cities);
        Yii::$app->db->createCommand()->batchInsert( 'vk_city',
            [
                'city_id',
                'title',
                'area',
                'region',
            ],
            $cities )->execute();
        return $this->redirect( [ '/admin' ] );
    }

    public function actionGetRegions()
    {
        $country_id = 2;
        $regions    = VkRegionHelper::getCities( $country_id );
        //ddd($regions);
        Yii::$app->db->createCommand()->batchInsert( 'vk_region',
            [
                'region_id',
                'title',
            ],
            $regions )->execute();
        return $this->redirect( [ '/admin' ] );
    }

    public function actionGetSchools($offset,$count)
    {
        $city_ids = range($offset, $offset + $count);

        //ddd($city_ids);
        $dbSchools         = VkSchool::find()->asArray()->all();
        $dbSchoolsIdsArray = [ ];
        foreach ($dbSchools as $school) {
            $dbSchoolsIdsArray[] = $school['school_id'];
        }
        //ddd($city_ids);
        $city         = VkCity::find($city_ids)->where(['id' => $city_ids])->asArray()->all();
//ddd($city);
        $city_id = ArrayHelper::getColumn($city, 'city_id');
        /*$city_id = [
            '1711'
        ];*/
        $schools = VkSchoolHelper::getSchools( $city_id );
        //ddd($schools);
        foreach ($schools as $key => $school) {
            if (in_array( $school['0'], $dbSchoolsIdsArray )) {
                unset( $schools[$key] );
            }
        }
        //ddd($schools);
        if (empty( $schools )) {
            return $this->redirect( [ '/admin' ] );
        }
        Yii::$app->db->createCommand()->batchInsert( 'vk_school',
            [
                'school_id',
                'title',
                'city_id',
            ],
            $schools )->execute();
        return $this->redirect( [ '/admin' ] );
    }

    public function actionGetSearch()
    {
        $dbUsers         = VkUser::find()->asArray()->all();
        $dbUsersIdsArray = [ ];
        foreach ($dbUsers as $user) {
            $dbUsersIdsArray[] = $user['user_id'];
        }
        //ddd($dbUsersIdsArray);
        $schools = VkSchool::find()->where( [ 'id' => range(151, 161) ] )->asArray()->all();

        //ddd($schools);
        $user_ids = VkSearchHelper::getSearch( $schools );
        //ddd($user_ids);
        foreach ($user_ids as $key => $user) {
            if (in_array( $user, $dbUsersIdsArray )) {
                unset( $user_ids[$key] );
            }
        }
        //ddd($user_ids);
        if (empty( $user_ids )) {
            return $this->redirect( [ '/admin' ] );
        }
        $users = VkUserHelper::getUsers( $user_ids );
        foreach ($users as $item) {
            Yii::$app->db->createCommand()->batchInsert( 'vk_user',
                [
                    'user_id',
                    'first_name',
                    'last_name',
                    'sex',
                    'bdate',
                    'city_id',
                    'city_title',
                    'country',
                    'photo_200_orig',
                    'domain',
                    'school_id',
                    'school_city_id',
                    'school_name',
                    'school_year_to',
                    'last_seen',
                    'can_post',
                    'can_write_private_message',
                    'description',
                    'active',
                    'created_at',
                    'updated_at',
                ],
                [$item] )->execute();
        }
        return $this->redirect( [ '/admin' ] );
    }
}






