<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Настройки"
?>
<div class="row">
    <div class="col-xs-9">
        <h1>Привязка аккаунта Tinkoff банка</h1>


        <p class="explanation-input">Укажите свой ИНН:</p>
        <div class="form-group">
            <input type="number" class="form-control input-lg" placeholder="ИНН">
        </div>
        <p class="explanation-input">Номер основного счёта компании:</p>
        <div class="form-group">
            <input type="number" class="form-control input-lg" placeholder="Номер счёта">
        </div>
        <button type="submit" class="btn btn-lg assist-btn-tinkoff">Сохранить</button>
    </div>
    <div class="col-xs-3">
        <img class="assist-logo-tinkoff" src="https://static.tinkoff.ru/brands/traiding/US87238U2033x640.png"/>
    </div>
</div>