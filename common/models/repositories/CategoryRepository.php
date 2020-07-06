<?php

namespace common\models\repositories;

class CategoryRepository extends \common\models\db\Category
{
    /**
     * @return CategoryRepository[]|[]
     */
    public static function getAll()
    {
        return self::find()->all();
    }

    /**
     * @param string $name
     * @return CategoryRepository|null
     */
    public static function getByName(string $name)
    {
        return self::find()->where(['category' => $name])->one();
    }

    /**
     * @param int $id
     * @return CategoryRepository|null
     */
    public static function getById(int $id)
    {
        return self::find()->where(['id' => $id])->one();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'category' => 'Категория',
        ];
    }
}
