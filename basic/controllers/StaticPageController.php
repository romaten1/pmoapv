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
     * @param integer $id
     * @return mixed
     */
    public function actionViewAlias($alias)
    {
       //var_dump($this->findModelByAlias($alias));
        return $this->render('view', [
            'model' => $this->findModelByAlias($alias),
        ]);
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
