<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 12/11/2017
 * Time: 12:04
 */

$this->title = $model->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keyword]);
$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);

echo \yii\widgets\DetailView::widget([
    'model' => $model,
]);