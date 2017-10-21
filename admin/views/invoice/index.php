<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

echo $this->render('_createInvoice', ['Html' => Html, 'ActiveForm' => ActiveForm]);
echo $this->render('_addGoods');
?>
<button type="submit" class="btn btn-lg assist-btn-tinkoff">Отправить счёт</button>