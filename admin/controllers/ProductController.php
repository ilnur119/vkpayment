<?php


namespace admin\controllers;


use common\models\Product;
use yii\web\Controller;

class ProductController extends Controller
{
    public function actionImportProduct($productId, $title, $description, $currency, $price, $thumbPhoto)
    {
        $product = new Product();
        $product->vk_product_id = $productId;
        $product->title = $title;
        $product->description = $description;
        $product->currency = $currency;
        $product->price = $price / 100;
        $product->thumb_photo = $thumbPhoto;
        $product->save();
    }
}