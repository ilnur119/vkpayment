<?php
?>
<div class="create-wrap" id="create-invoice">
    <div class="create-header-wrap">
        <div class="create-header">
            <div class="name-block">#1 Создание счёта</div>
            <div class="save-block">
                <button class="btn btn-vk">Сохранить</button>
            </div>
        </div>
    </div>
    <div class="create-content">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="checkboxVk" id="checkboxIsThereVk" value="isThereVK" checked>
                Есть профиль в ВК
            </label>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <p class="explanation-input">Имя:</p>
                <div class="form-group">
                    <input class="form-control input-lg" placeholder="Имя">
                </div>
            </div>
            <div class="col-sm-6" id="block-link-vk">
                <p class="explanation-input">Ссылка на профиль ВК:</p>
                <div class="form-group">
                    <input class="form-control input-lg" placeholder="Ссылка">
                </div>
            </div>
            <div class="col-sm-12">
                <div class="form-group">
                    <label class="control-label">ИНН:</label>
                    <input type="number" class="form-control" placeholder="ИНН">
                </div>
            </div>

            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Email:</label>
                    <input type="email" class="form-control" placeholder="Email">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label class="control-label">Номер телефона:</label>
                    <input class="form-control" placeholder="Номер">
                </div>
            </div>
        </div>
        <hr/>

        <p class="explanation-input">Банковские реквезиты:</p>
        <div class="form-horizontal">
            <div class="form-group">
                <label class="col-sm-3 control-label">Название банка</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Название">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Адрес банка</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Адрес">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">БИК</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="БИК">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Корреспондентский счет</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Корр. счёт">
                </div>
            </div>
        </div>
    </div>
</div>
