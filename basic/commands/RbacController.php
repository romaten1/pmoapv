<?php
namespace app\commands;

use dektrium\user\models\User;
use Yii;
use yii\base\InvalidParamException;
use yii\console\Controller;
use yii\rbac\DbManager;

/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
	public function actionInit()
    {
        if (!$this->confirm("Are you sure? It will re-create permissions tree.")) {
            return self::EXIT_CODE_NORMAL;
        }

        //$auth = Yii::$app->authManager;
	    // Підключення через Базу даних
	    $auth = new DbManager;
	    $auth->init();
        $auth->removeAll();

        //Не використовується! Управління новинами, статичними сторінками, предметами, методичками - для модераторів (викладачів)
	    $adminNews = $auth->createPermission('adminNews');
        $adminNews->description = 'Administrate news, staticPages, predmets, metodychkies';
        $auth->add($adminNews);

	    // Не використовується! Управління користувачами
        $adminUsers = $auth->createPermission('adminUsers');
        $adminUsers->description = 'Administrate users and teachers';
        $auth->add($adminUsers);

	    // Оновлення методичок тільки автором
	    // add "updateMetodychka" permission
	    $updateMetodychka = $auth->createPermission('updateMetodychka');
	    $updateMetodychka->description = 'Update Metodychka';
	    $auth->add($updateMetodychka);

	    //Оновлення повідомлень викладачів тільки автором
	    // add "updateTeacherNews" permission
	    $updateTeacherNews = $auth->createPermission('updateTeacherNews');
	    $updateTeacherNews->description = 'Update TeacherNews';
	    $auth->add($updateTeacherNews);

	    // Роль студент
	    $student = $auth->createRole('student');
	    $student->description = 'Student';
	    $auth->add($student);

        // Роль модератор - для викладачів, наслідує роль студент
	    $moderator = $auth->createRole('moderator');
        $moderator->description = 'Moderator';
        $auth->add($moderator);
        $auth->addChild($moderator, $adminNews);
	    $auth->addChild($moderator, $student);

	    // add the rule
	    $rule = new \app\rbac\AuthorMetodychkaRule;
	    $auth->add($rule);
	    // add the "updateOwnMetodychka" permission and associate the rule with it.
	    $updateOwnMetodychka = $auth->createPermission('updateOwnMetodychka');
	    $updateOwnMetodychka->description = 'Update own Metodychka';
	    $updateOwnMetodychka->ruleName = $rule->name;
	    $auth->add($updateOwnMetodychka);

	    // "updateOwnMetodychka" will be used from "updateMetodychka"
	    $auth->addChild($updateOwnMetodychka, $updateMetodychka);
	    // allow "moderator" to update their own posts
	    $auth->addChild($moderator, $updateOwnMetodychka);

	    // add the rule
	    $rule = new \app\rbac\AuthorTeacherNewsRule;
	    $auth->add($rule);
	    // add the "updateOwnTeacherNews" permission and associate the rule with it.
	    $updateOwnTeacherNews = $auth->createPermission('updateOwnTeacherNews');
	    $updateOwnTeacherNews->description = 'Update own TeacherNews';
	    $updateOwnTeacherNews->ruleName = $rule->name;
	    $auth->add($updateOwnTeacherNews);

	    // "updateOwnTeacherNews" will be used from "updateTeacherNews"
	    $auth->addChild($updateOwnTeacherNews, $updateTeacherNews);
	    // allow "moderator" to update their own TeacherNews
	    $auth->addChild($moderator, $updateOwnTeacherNews);

        $admin = $auth->createRole('admin');
        $admin->description = 'Administrator';
        $auth->add($admin);
	    $auth->addChild($admin, $updateMetodychka);
	    $auth->addChild($admin, $updateTeacherNews);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $adminUsers);
    }

    public function actionAssign($role, $userId)
    {
        $user = User::findOne($userId);
        if (!$user) {
            throw new InvalidParamException('There is no such user.');
        }

        $auth = Yii::$app->authManager;
        $role = $auth->getRole($role);
        if (!$role) {
            throw new InvalidParamException('There is no such role.');
        }

        $auth->assign($role, $userId);
    }
}