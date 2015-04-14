<?php
use app\modules\admin\components\contacts\ContactsWidget;
use app\modules\admin\components\lastUsers\LastUsersWidget;
use app\modules\admin\components\message\MessageWidget;

?>
<h1>Панель адміністрування сайту</h1>
<div class="row">
    <?php echo ContactsWidget::widget(); ?>
    <?php echo LastUsersWidget::widget(); ?>
    <?php echo MessageWidget::widget(); ?>
</div>



