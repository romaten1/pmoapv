<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\RegistrationForm $model
 */
$this->title                   = Yii::t( 'user', 'Sign up' );
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="panel panel-danger">
        <div class="panel-body">
            Просимо дотримуватися культури
            спілкування та не застосовувати лайливі вислови при спілкуванні з користувачами сайту.
            При порушенні вас буде забанено. Свої запитання та зауваження ви можете задати на сторінці
            <?= Html::a( 'контактів', [ '/site/contact' ] ) ?>
        </div>
    </div>
    <div class="panel panel-success">
        <div class="panel-body">
            <strong>До уваги студентів, які навчаються на кафедрі процесів, машина та обладнання АПВ!</strong> <br />
            Для того щоб отримати більше можливостей при використанні сайту кафедри після реєстрації вам потрібно
            <?= Html::a( 'написати повідомлення адміністратору сайту', [ '/message/user-message', 'receiver_id' => 2 ]) ?>
            де вказати в якій ви групі навчаєтеся, після чого на протязі доби вам буде надано права
            студента, які надають можливість, наприклад, переглядати та скачувати електронні
            варіанти методичних вказівок.
            У випадку виявлення недоречної роботи сайту, помилок або наявності запитань також звертайтесь до адміністратора!

        </div>
    </div>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?= Html::encode( $this->title ) ?></h3>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin( [
                    'id' => 'registration-form',
                ] ); ?>

                <?= $form->field( $model, 'username' ) ?>

                <?= $form->field( $model, 'email' ) ?>

                <?= $form->field( $model, 'password' )->passwordInput() ?>

                <?= $form->field( $model, 'captcha' )->widget( Captcha::className(),
                    [ 'captchaAction' => '/user/registration/captcha' ] ) ?>

                <?= Html::submitButton( Yii::t( 'user', 'Sign up' ), [ 'class' => 'btn btn-success btn-block' ] ) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <p class="text-center">
            <?= Html::a( Yii::t( 'user', 'Already registered? Sign in!' ), [ '/user/security/login' ] ) ?>
        </p>
    </div>
</div>