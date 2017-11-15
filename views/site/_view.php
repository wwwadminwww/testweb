<?php
use yii\helpers\HtmlPurifier;
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div>
    <h2><?= Html::a($model->name, Url::to(['site/detail', 'slug' => $model->slug]));?></h2>
    <?= HtmlPurifier::process($model->body);?>
</div>