<?php

namespace app\models;


/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $keyword
 * @property string $description
 * @property string $name
 * @property string $body
 * @property string $slug
 * @property integer $category_id
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword', 'description', 'body'], 'string'],
            [['name', 'body', 'slug', 'category_id'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'keyword' => 'Keyword',
            'description' => 'Description',
            'name' => 'Name',
            'body' => 'Body',
            'slug' => 'Slug',
            'category_id' => 'Category ID',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
