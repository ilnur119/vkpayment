<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//echo $this->render('_addGoods');
$form = ActiveForm::begin([
    'id' => 'invoice-form',
    'options' => ['class' => ''],
]) ?>
    <div class="create-wrap" id="create-invoice">
        <div class="create-header-wrap">
            <div class="create-header">
                <div class="name-block">#1 Создание счёта</div>
                <div class="save-block">
                </div>
            </div>
        </div>
        <div class="create-content">
            <div class="checkbox">
                <?= $form->field($model, 'isLinkVk')
                    ->checkbox([
                        'label' => 'Есть профиль в ВК клиента',
                        'id' => 'checkboxIsThereVk',
                        'uncheck' => 'Disabled',
                        'labelOptions' => [
                            'style' => 'padding-left:20px;'
                        ],
                    ]); ?>
            </div>

            <div class="row">
                <div class="col-xs-6">
                    <p class="explanation-input">Имя:</p>
                    <?= $form->field($model, 'name')->
                    textInput(['placeholder' => 'Имя', 'class' => 'form-control input-lg'])->label(false) ?>
                </div>
                <div class="col-xs-6" id="block-link-vk">
                    <p class="explanation-input">Ссылка на профиль ВК:</p>
                    <?= $form->field($model, 'linkVk')->
                    textInput(['placeholder' => 'Ссылка', 'class' => 'form-control input-lg'])->label(false) ?>
                </div>

                <div class="col-xs-12">
                    <?= $form->field($model, 'inn')->
                    textInput(['placeholder' => 'ИНН', 'class' => 'form-control'])->label('ИНН:') ?>
                </div>

                <div class="col-xs-6">
                    <?= $form->field($model, 'email')->
                    textInput(['placeholder' => 'Email', 'class' => 'form-control'])->label('Email') ?>
                </div>

                <div class="col-xs-6">
                    <?= $form->field($model, 'phone')->
                    textInput(['placeholder' => 'Номер', 'class' => 'form-control'])->label('Номер телефона') ?>
                </div>

                <div class="col-xs-12">
                    <?= $form->field($model, 'customerAddress')->
                    textInput(['placeholder' => 'Адрес клиента', 'class' => 'form-control'])->label('Адрес доставки:') ?>
                </div>
            </div>
            <hr/>


            <?php
            $template = "{label}\n<div class=\"col-xs-9\">{input}\n</div>\n{hint}\n{error}\n";
            ?>
            <p class="explanation-input">Банковские реквезиты:</p>
            <div class="form-horizontal">
                <?= $form->field($model, 'name_bank', ['template' => $template])->
                textInput(['placeholder' => 'Название', 'class' => 'form-control'])->label('Название банка', ['class' => 'col-xs-3 control-label']) ?>

                <?= $form->field($model, 'address_bank', ['template' => $template])->
                textInput(['placeholder' => 'Адрес', 'class' => 'form-control'])->label('Адрес банка', ['class' => 'col-xs-3 control-label']) ?>

                <?= $form->field($model, 'bic', ['template' => $template])->
                textInput(['placeholder' => 'БИК', 'class' => 'form-control'])->label('БИК', ['class' => 'col-xs-3 control-label']) ?>

                <?= $form->field($model, 'corrInvoice', ['template' => $template])->
                textInput(['placeholder' => 'Корреспондентский счет', 'class' => 'form-control'])->label('Корреспондентский счет', ['class' => 'col-xs-3 control-label']) ?>
            </div>
        </div>
    </div>

    <div class="create-wrap" id="create-invoice">
        <div class="create-header-wrap">
            <div class="create-header">
                <div class="name-block">#2 Добавление товаров</div>
                <div class="save-block">
                </div>
            </div>
        </div>
        <div class="create-content scroll-item">
            <p class="explanation-input">Выберите товары:</p>
            <div class="row">
                <?php foreach($products as $product): ?>
                    <div class="col-xs-6">
                        <div class="goods-wrap">
                            <img class="goods-img"
                                 src="<?= $product->thumb_photo ?>"/>
                            <div class="goods-content">
                                <p class="goods-name"><?= $product->title ?></p>
                                <p class="goods-price"><?= "{$product->price} {$product->currency}"?></p>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Добавить в счет
                                    </label>
                                </div>
                                <div class="row">
                                    <label for="inputEmail3" class="col-xs-6 control-label text-right">Кол-во:</label>
                                    <div class="col-xs-6" style="padding-left: 0px">
                                        <input type="number" class="form-control input-sm" id="inputEmail3" value="1"
                                               placeholder="Количество">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?= Html::submitButton('Отправить счёт', ['class' => 'btn btn-lg assist-btn-tinkoff']) ?>
<?php ActiveForm::end() ?>