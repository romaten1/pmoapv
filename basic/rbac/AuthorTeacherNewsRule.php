<?php
namespace app\rbac;

use app\models\TeacherNews;
use yii\rbac\Rule;
use Yii;
/**
 * Checks if authorID matches user passed via params
 */
class AuthorTeacherNewsRule extends Rule
{
	public $name = 'isTeacherNewsAuthor';

	/**
	 * @param string|integer $user the user ID.
	 * @param Item $item the role or permission that this rule is associated with
	 * @param array $params parameters passed to ManagerInterface::checkAccess().
	 * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
	 */
	public function execute($user, $item, $params)
	{
		$result = false;
		if(isset($params['teacherNews_id'])){
			$teacherNews = TeacherNews::findOne($params['teacherNews_id']);
			if($teacherNews->teacher_id == Yii::$app->user->id){
				$result = true;
			}
		}
		return $result;
	}
}