<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "favorites".
 *
 * @property int $id ID
 * @property int $user_id_customer id заказчика
 * @property int $user_id_builder id исполнителя
 *
 * @property Users $userIdCustomer
 * @property Users $userIdBuilder
 */
class Favorites extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorites';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id_customer', 'user_id_builder'], 'required'],
            [['user_id_customer', 'user_id_builder'], 'integer'],
            [['user_id_customer'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id_customer' => 'id']],
            [['user_id_builder'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id_builder' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id_customer' => 'id заказчика',
            'user_id_builder' => 'id исполнителя',
        ];
    }

    /**
     * Gets query for [[UserIdCustomer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdCustomer()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id_customer']);
    }

    /**
     * Gets query for [[UserIdBuilder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserIdBuilder()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id_builder']);
    }
}
