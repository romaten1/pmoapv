<?php

namespace app\modules\books\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property Books[] $books
 */
class Authors extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id']);
    }

    /**
     * @return array
     *
     * Возвращает массив созданных полных имен авторов с ключами $author['id']
     */
    public static function getAuthorsArray()
    {
        $authors = self::find()->asArray()->all();
        $authors_result = [];
        foreach ($authors as $author) {
            $authors_result[$author['id']] = $author['first_name'] . ' ' . $author['last_name'];
        }
        return $authors_result;
    }

    /**
     * @param $id
     *
     * @return string
     *
     * Возвращает полное имя автора по его $id
     */
    public static function getAuthorById($id)
    {
        $author = self::find()->where(['id' => $id])->one();
        return $author->first_name . ' ' . $author->last_name;
    }
}
