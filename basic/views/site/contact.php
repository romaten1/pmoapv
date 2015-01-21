<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model app\models\ContactForm */

$this->title =  'Контакти';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-5">
            <h4>Поштова адреса:</h4>
            <p>Уманський національний університет садівництва</p>
            <p>Кафедра процесів, машин та обладнання АПВ</p>
            <p>пров. Інтернаціональний, 1</p>
            <p>м. Умань, Черкаська обл.</p>
            <p>Україна</p>
            <p>Індекс: 20305</p>
            <abbr title="Phone">Телефон:</abbr> <br />
            (04744) 3-98-37, 3-98-93 <br />
            <abbr title="Mail">Email:</abbr><br />
            pmoapv@meta.ua
        </div>
        <div class="col-md-7">
            <iframe src="https://mapsengine.google.com/map/embed?mid=zWdXVPtDflqc.ka15_zYzVfWc" width="640" height="480"></iframe>
        </div>
    </div>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

    <div class="alert alert-success">
        Дякуємо, що зв'язалися з нами. Ми відповімо Вам як тільки зможемо.
    </div>

    

    <?php else: ?>
    <div class="row">
        <div class="col-md-7">
            <h3>
                Якщо ви маєте пропозиції або запитання, заповніть дану форму.  
                Дякуємо!
            </h3>
            <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'subject') ?>
                <?= $form->field($model, 'body')->textArea(['rows' => 6]) ?>
                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                    'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton('Відправити', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
        
    </div>

    <?php endif; ?>
</div>
