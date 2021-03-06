<?php
namespace app\rbac;

use app\models\Metodychky;
use app\models\Teacher;
use yii\rbac\Rule;
use Yii;
/**
 * Checks if authorID matches user passed via params
 */
class AuthorMetodychkaRule extends Rule
{
	public $name = 'isAuthor';

	/**
	 * @param string|integer $user the user ID.
	 * @param Item $item the role or permission that this rule is associated with
	 * @param array $params parameters passed to ManagerInterface::checkAccess().
	 * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
	 */
	public function execute($user, $item, $params)
	{
		$result = false;
		if(isset($params['metodychka_id'])){

			$metodychka = Metodychky::findOne($params['metodychka_id']);
			foreach($metodychka->teachers as $teacher){

				$user = Teacher::getUserByTeacherId($teacher->id);
				if($user->id == Yii::$app->user->id){
					$result = true;
				}
			}

		}
		return $result;
	}
}