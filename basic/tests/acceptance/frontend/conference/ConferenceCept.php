<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that Conferrence index page works');
$I->amOnPage('web/index.php?r=conference');
$I->see('ПМОАПВ');
$I->see('Наукові заходи');
$I->seeLink('Контакти');
$I->seeLink('Наукова конференція - тестовий запис');

