<?php


namespace admin\controllers;


use common\models\Product;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionImportProduct($productId, $title, $description, $currency, $price, $thumbPhoto, $appId)
    {
        $product = new Product();
        $product->application_id = $appId;
        $product->vk_product_id = $productId;
        $product->title = $title;
        $product->description = $description;
        $product->currency = $currency;
        $product->price = $price / 100;
        $product->thumb_photo = $thumbPhoto;
        $product->save();
    }
}