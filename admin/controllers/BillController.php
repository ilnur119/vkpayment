<?php
/**
 * Created by IntelliJ IDEA.
 * User: ilnur
 * Date: 20.10.17
 * Time: 11:21
 */

namespace admin\controllers;


class BillController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}