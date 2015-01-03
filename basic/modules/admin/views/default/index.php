<?php 
use app\modules\admin\components\contacts\ContactsWidget;
 ?>

<div class="admin-default-index">
    <h1>Панель адміністрування сайту</h1>
    <br />
    <?php echo ContactsWidget::widget(); ?>    
</div>
