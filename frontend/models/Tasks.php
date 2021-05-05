<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id ID
 * @property string|null $date_add Дата создания
 * @property int $customer_id id заказчика
 * @property int|null $builder_id id исполнителя
 * @property string|null $job Краткое описание задания
 * @property string|null $description Подробности задания
 * @property int $category_id id категории работ
 * @property string|null $address Адрес исполнения
 * @property int|null $cities_id id населенного пункта
 * @property string|null $latitude Широта
 * @property string|null $longitude Долгота
 * @property int|null $budget Бюджет
 * @property string|null $date_expire Дата исполнения
 * @property string|null $status Статус задания
 *
 * @property Files[] $files
 * @property Messages[] $messages
 * @property Opinions[] $opinions
 * @property Responses[] $responses
 * @property Categories $category
 * @property Users $customer
 * @property Users $builder
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_add', 'date_expire'], 'safe'],
            [['customer_id', 'category_id'], 'required'],
            [['customer_id', 'builder_id', 'category_id', 'cities_id', 'budget'], 'integer'],
            [['description'], 'string'],
            [['job', 'address'], 'string', 'max' => 255],
            [['latitude', 'longitude'], 'string', 'max' => 15],
            [['status'], 'string', 'max' => 45],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['builder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['builder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_add' => 'Дата создания',
            'customer_id' => 'id заказчика',
            'builder_id' => 'id исполнителя',
            'job' => 'Краткое описание задания',
            'description' => 'Подробности задания',
            'category_id' => 'id категории работ',
            'address' => 'Адрес исполнения',
            'cities_id' => 'id населенного пункта',
            'latitude' => 'Широта',
            'longitude' => 'Долгота',
            'budget' => 'Бюджет',
            'date_expire' => 'Дата исполнения',
            'status' => 'Статус задания',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Opinions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinions::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['task_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Customer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Users::className(), ['id' => 'customer_id']);
    }

    /**
     * Gets query for [[Builder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuilder()
    {
        return $this->hasOne(Users::className(), ['id' => 'builder_id']);
    }

    /**
     * Получить интервал между датой создания задания и текущей датой
     *
     * @return string
     */
    public function getPeriodCreate() : string
    {
        $date = new \DateTime($this->date_add);

        return Yii::$app->formatter->asRelativeTime($date);
    }
}
