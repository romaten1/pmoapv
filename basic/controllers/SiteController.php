<?php

namespace app\controllers;

use app\models\News;
use app\models\Teacher;
use DOMDocument;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only'  => [ 'logout' ],
				'rules' => [
					[
						'actions' => [ 'logout' ],
						'allow'   => true,
						'roles'   => [ '@' ],
					],
				],
			],
			'verbs'  => [
				'class'   => VerbFilter::className(),
				'actions' => [
					'logout' => [ 'post' ],
				],
			],
		];
	}

	public function actions()
	{
		return [
			'error'   => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class'           => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	public function actionIndex()
	{
		$this->layout = 'index';
		return $this->render( 'index' );
	}

	public function actionAbiturient()
	{
		$this->layout = 'abiturient';
		$model        = new ContactForm();
		if ($model->load( Yii::$app->request->post() )) {
			$model->active      = ContactForm::STATUS_ACTIVE;
			$model->created_at  = time();
			$model->reviewed_at = '1';
			if ($model->validate() && $model->save( false )) {
				Yii::$app->session->setFlash( 'contactFormSubmitted' );
				return $this->refresh();
			}
		} else {
			return $this->render( 'abiturient', [
				'model' => $model,
			] );
		}
	}

	public function actionCooperation()
	{
		$this->layout = 'cooperation';
		return $this->render( 'cooperation' );
	}


	public function actionSearch()
	{
		return $this->render( 'search' );
	}

	public function actionRozklad()
	{
		return $this->render( 'rozklad' );
	}

	public function actionLogin()
	{
		if ( ! \Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load( Yii::$app->request->post() ) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render( 'login', [
				'model' => $model,
			] );
		}
	}

	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	public function actionContact()
	{
		$this->layout = 'contact';
		$model        = new ContactForm();
		if ($model->load( Yii::$app->request->post() )) {
			$model->active      = ContactForm::STATUS_ACTIVE;
			$model->created_at  = time();
			$model->reviewed_at = '1';
			if ($model->validate() && $model->save( false )) {
				Yii::$app->session->setFlash( 'contactFormSubmitted' );
				return $this->refresh();
			}
		} else {
			return $this->render( 'contact', [
				'model' => $model,
			] );
		}
	}

	public function actionAbout()
	{
		return $this->render( 'about' );
	}

	// Для експорта новостей, событий или данных о преподавателях на сайт УНУС
	public function actionExport( $type )
	{
		\Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
		//var_dump(\Yii::$app->response); exit;

		$this->layout = 'export';
		$models = [ ];
		$data   = [ ];
		$i      = 0;
		switch ($type) {
			case 'event':
				break;
			case 'news':
				$models = News::find()
				              ->active_news()
				              ->where( [ 'unus_public' => News::UNUS_PUBLIC_YES ] )
				              ->orderBy( [ 'updated_at' => SORT_DESC ] )
				              ->limit( 10 )
				              ->all();
				foreach ($models as $model) {
					$data[$i]['title']       = $model['title'];
					$data[$i]['description'] = $model['description'] . $model['text'];
					$content = $data[$i]['description'];
					$content = preg_replace("/<img[^>]+\>/i", "", $content);
					$data[$i]['description'] =  $content;
					$data[$i]['url']         = Url::to( ['/news/view/',  'id' => $model['id'] ], true );
					$data[$i]['image']       = 'http://pmoapv.pp.ua/web/uploads/news/' . $model['image'];
					$data[$i]['date']        = date( 'd-m-Y', $model['created_at'] );
					$i++;
				}
				break;
			case 'staff':
				$models = Teacher::find()
				              ->where( [ 'active' => Teacher::STATUS_ACTIVE,
				                         'teach_or_master' => Teacher::STATUS_TEACHER ] )
				              ->all();
				foreach ($models as $model) {
					$data[$i]['title']       = $model['last_name'] . ' ' . $model['name'] . ' ' .  $model['second_name'];;
					$data[$i]['description'] = $model['job'] . ' ' . $model['science_status'] . '<br />' . $model['description'];
					$data[$i]['url']         = Url::to( ['/teacher/view/',  'id' => $model['id'] ], true );
					$data[$i]['image']       = 'http://pmoapv.pp.ua/web/uploads/teacher/' . $model['image'];
					$data[$i]['date']        = '';
					$i++;
				}
				break;
			default:
				;
		}
		$data['pages'] = $data;
		return $data;
	}
}
