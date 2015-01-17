<?php
use yii\helpers\Html;

?>
<footer class="footer">
    <div class="container">
        <div class="col-md-5">
            <address>
                <strong>&copy; ПМОАПВ <?= date('Y') ?></strong><br/>
                м. Умань, пров. Інтернаціональний, 1<br>
                <abbr title="Phone">Тел:</abbr> (04744) 3-98-37, 3-98-93<br/>
                <abbr title="Mail">E-mail:</abbr> pmoapv@meta.ua, kafedra.pmo@gmail.com
            </address>
        </div>
        <div class="col-md-2">
            <?= Html::a('Про кафедру', ['/static-page/view-alias', 'alias' => 'about']); ?><br/>
            <?= Html::a('Історія кафедри', ['/static-page/view-alias', 'alias' => 'history']); ?><br/>
            <?= Html::a('Викладацький склад', ['/teacher']); ?><br/>
            <?= Html::a('Предмети', ['/predmet']); ?>
        </div>
        <div class="col-md-3">
            <?= Html::a('Абітурієнтам', ['/static-page/view-alias', 'alias' => 'zvernennya']); ?><br/>
            <?= Html::a('Методичне забезпечення', ['/metodychky']); ?><br/>
            <?= Html::a('Наукові дослідження', ['/static-page/view-alias', 'alias' => 'napryamy-nauki']); ?><br/>
            <?= Html::a('Пропозиції виробникам', ['/static-page/view-alias', 'alias' => 'proposal']); ?>
        </div>
        <div class="col-md-2">
            <strong> <?= Html::a('Контакти', ['/site/contact']); ?></strong><br/>

        </div>
    </div>
</footer>