<?php
$rand = rand(0, 10000);
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that Teacher index page and view works');
$I->amOnPage('basic/web/index.php?r=user/security/login');
$I->fillField('#login-form-login','admin');
$I->fillField('#login-form-password','804744');
$I->click ('Авторизуватися');
$I->seeLink('Викладацький склад');
$I->click('Викладацький склад');

$I->see('ПМОАПВ');
$I->see('Викладачі');
$I->see('Інтернаціональний');
$I->seeLink('Новини кафедри');
$I->seeLink('Контакти');
$I->seeLink('Методичні вказівки');
$I->seeLink('Войтік Андрій Володимирович');
$I->click('Войтік Андрій Володимирович');

$I->see('Посада');
$I->seeLink('Звернутись до викладача');
$I->click('Звернутись до викладача');

$I->see('Написати повідомлення');
$I->see('Войтік Андрій Володимирович');
$I->fillField('#message-text','Коротке тестове повідомлення'.$rand);
$I->click('Створити');
$I->seeInDatabase('message', array('author_id' => 2, 'text' => 'Коротке тестове повідомлення'.$rand));

$I->see('Отримані повідомлення');
$I->seeLink('Надіслані повідомлення');
$I->click('Надіслані повідомлення');

$I->see('Отримані повідомлення');
$I->see('Коротке тестове повідомлення'.$rand);

