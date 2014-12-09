<?php

namespace app\controllers\;

class StaticController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Displays a single Static page.
     * @param integer $id
     * @return mixed
     */
    public function actionView($alias)
    {
        return $this->render('view', [
            'model' => $this->findModel($alias),
        ]);
    }

}
