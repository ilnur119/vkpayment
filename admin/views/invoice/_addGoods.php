<?php
?>
<div class="create-wrap" id="create-invoice">
    <div class="create-header-wrap">
        <div class="create-header">
            <div class="name-block">#2 Добавление товаров</div>
            <div class="save-block">
            </div>
        </div>
    </div>
    <div class="create-content">
        <p class="explanation-input">Выберите товары:</p>
        <div class="row">
            <? for ($i = 0; $i < 5; $i++) {?>
            <div class="col-xs-6">
                <div class="goods-wrap">
                    <img class="goods-img" src="https://pp.userapi.com/c841121/v841121898/2efbe/KBqb1xSQjlo.jpg"/>
                    <div class="goods-content">
                        <p class="goods-name">Блейд серии 500 м лески мононить Daiwa Японии</p>
                        <p class="goods-price">1000 руб.</p>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Добавить в корзину
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
            <? } ?>
        </div>
    </div>
</div>
