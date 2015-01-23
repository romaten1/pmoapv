<?php

namespace app\controllers;

use Yii;
use app\models\StaticPage;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * StaticPageController implements the CRUD actions for StaticPage model.
 */
class StaticPageController extends Controller
{
    public $layout = 'static';

    /**
     * Displays a single StaticPage model.
     * @param integer $alias
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionViewAlias($alias)
    {
	    $model = $this->findModelByAlias($alias);
	    if ($model->active == StaticPage::STATUS_ACTIVE) {
		    return $this->render('view', [
			    'model' => $model,
		    ]);
	    } else {
		    throw new NotFoundHttpException('Запис не активний');
	    }
    }

 
    protected function findModelByAlias($alias)
    {
        if (($model = StaticPage::find()->where(['alias' => $alias])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
