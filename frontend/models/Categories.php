<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $id ID
 * @property string $category Наименование категории
 * @property string|null $icon Иконка
 *
 * @property Skills[] $skills
 * @property Tasks[] $tasks
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category', 'icon'], 'string', 'max' => 70],
            [['category'], 'default', 'value' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
//            'category' => 'Наименование категории',
//            'icon' => 'Иконка',
        ];
    }

    /**
     * Gets query for [[Skills]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSkills()
    {
        return $this->hasMany(Skills::className(), ['category_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['category_id' => 'id']);
    }

    /**
     * получение массива категорий вида ['id категории' => 'наименовани категории', ...]
     *
     * @return array
     */
    public static function getCategoriesCheck() : array
    {
        $cats = Categories::find()->all();
        $categories_check = [];
        foreach ($cats as $value) {
            $categories_check[$value->id] = 1;
        }
        return $categories_check;
    }
}
