<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "opinions".
 *
 * @property int $id ID
 * @property int $user_id id исполнителя
 * @property int $task_id id задания
 * @property int $review_author_id id заказчика
 * @property string|null $date_add Дата добавления
 * @property int $rating Оценка
 * @property string|null $description Отзыв
 *
 * @property Tasks $task
 * @property Users $user
 * @property Users $reviewAuthor
 */
class Opinions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'opinions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'task_id', 'review_author_id'], 'required'],
            [['user_id', 'task_id', 'review_author_id', 'rating'], 'integer'],
            [['date_add'], 'safe'],
            [['description'], 'string'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['review_author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['review_author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'id исполнителя',
            'task_id' => 'id задания',
            'review_author_id' => 'id заказчика',
            'date_add' => 'Дата добавления',
            'rating' => 'Оценка',
            'description' => 'Отзыв',
        ];
    }

    /**
     * Gets query for [[Task]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * Gets query for [[ReviewAuthor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReviewAuthor()
    {
        return $this->hasOne(Users::className(), ['id' => 'review_author_id']);
    }
}
