<?php
use app\modules\admin\components\contacts\ContactsWidget;
use app\modules\admin\components\lastUsers\LastUsersWidget;
use app\modules\admin\components\message\MessageWidget;

?>
<h1>Панель адміністрування сайту</h1>
<div class="row">
	<div class="col-md-3">
		<?php echo ContactsWidget::widget(); ?>
	</div>
	<div class="col-md-4">
		<?php echo LastUsersWidget::widget(); ?>
	</div>
	<div class="col-md-5">
		<?php echo MessageWidget::widget(); ?>
	</div>
</div>



