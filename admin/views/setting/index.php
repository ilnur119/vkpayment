<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Настройки"
?>
<div class="row">
    <div class="col-xs-9">
        <h1>Привязка аккаунта Tinkoff банка</h1>
        <?php
        $form = ActiveForm::begin([
            'id' => 'setting-form',
            'options' => ['class' => ''],
        ]) ?>
        <p class="explanation-input">Укажите свой ИНН:</p>
        <?= $form->field($model, 'inn')->textInput(['type' => 'number', 'placeholder' => 'ИНН', 'class' => 'form-control input-lg'])->label(false) ?>

        <p class="explanation-input">Номер основного счёта компании:</p>
        <?= $form->field($model, 'account')->textInput(['type' => 'number', 'placeholder' => 'Номер счёта', 'class' => 'form-control input-lg'])->label(false) ?>

        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-lg assist-btn-tinkoff']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-xs-3">
        <img class="assist-logo-tinkoff" src="https://static.tinkoff.ru/brands/traiding/US87238U2033x640.png"/>
    </div>
</div>

<script>
    VK.callMethod("showGroupSettingsBox", 4096);
    VK.addCallback('onGroupSettingsChanged', function f(e) {
        console.log(e);
    });
    var isAsk = "<?= Yii::$app->session->has('ask_market_permission') ?>";
    if (isAsk) {
        VK.callMethod("showSettingsBox", 134217728);
        VK.addCallback('onSettingsChanged', function f(e) {
            console.log(e);
            VK.api("market.get", {"owner_id": -<?= Yii::$app->user->identity->application->vk_group_id ?>}, function (data) {
                console.log(data);
                data = data.response;
                for (var i = 1; i < data.length; i++) {
                    $.get('/admin/product/import-product', {
                        'appId': <?= Yii::$app->user->identity->application->id ?>,
                        'productId': data[i].id,
                        'title': data[i].title,
                        'description': data[i].description,
                        'currency': data[i].price.currency.name,
                        'price': data[i].price.amount,
                        'thumbPhoto': data[i].thumb_photo
                    }, function (data) {
                        console.log(data);
                    }).fail(function(data) {
                        console.log(data);
                    });
                }
            });
        });
    }
</script>