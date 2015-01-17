<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this \yii\web\View */
/* @var $content string */
$this->title =  'Контакти';
?>
<form id="contact-form" action="/basic/web/index.php?r=site%2Fcontact" method="post">
                        <input type="hidden" name="_csrf" value="bVBkRVBJTU5bEj0OOWQAfQMTNzI9eRI2HwkedjoiIAghHBwVFA4JFg==">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group field-contactform-name required">                                  
                                    <input type="text" id="contactform-name" class="form-control" name="ContactForm[name]" placeholder="Ваше ім'я *">
                                    <div class="help-block text-danger"></div>
                                </div>
                                <div class="form-group field-contactform-email required">                                  
                                    <input type="text" id="contactform-email" class="form-control" name="ContactForm[email]" placeholder="Ваш Email *">
                                    <div class="help-block text-danger"></div>
                                </div>
                                <div class="form-group field-contactform-subject required">                                  
                                    <input type="text" id="contactform-subject" class="form-control" name="ContactForm[subject]" placeholder="Тема повідомлення">
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group field-contactform-body required">                                  
                                    <textarea type="text" id="contactform-body" class="form-control" name="ContactForm[body]" placeholder="Текст повідомлення"></textarea>
                                    <div class="help-block text-danger"></div>
                                </div>
                                <div class="form-group field-contactform-verifycode">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img id="contactform-verifycode-image" src="/basic/web/index.php?r=site%2Fcaptcha&amp;v=54b6167aca230" alt="">
                                        </div>
                                        <div class="col-lg-6">
                                            <input type="text" id="contactform-verifycode" class="form-control" name="ContactForm[verifyCode]" placeholder="Код перевірки">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl" name="contact-button">Відправити</button>
                            </div>
                            
                        </div>
                    </form>