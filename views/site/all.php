<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 11/11/2017
 * Time: 16:39
 */

echo \yii\widgets\ListView::widget([
    'dataProvider' => $posts,
    'itemView' => function($model){
        return $this->render('_view', ['model' => $model]);
    },
]);
?>
<code><?= __FILE__ ?></code>

