<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 12/11/2017
 * Time: 14:46
 */
use yii\helpers\Html;
use yii\helpers\Url;

foreach ($model->posts as $item){
    echo Html::a($item->name, Url::to(['site/detail', 'category' => $item->category->slug ,'slug' => $item->slug]))."<br />";
}