<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id ID
 * @property string $email Электронная почта
 * @property string $login Логин
 * @property string $password Пароль
 * @property string|null $date_add Дата регистрации
 * @property int $city_id id населенного пугкта
 * @property string|null $avatar Аватар
 * @property string|null $birthday Дата рождения
 * @property string|null $about_me О пользователе
 * @property string|null $phone Телефон
 * @property string|null $skype Skype
 * @property string|null $telegram Telegram
 * @property float|null $raiting Рейтинг
 * @property string|null $last_activity Дата последней активности
 * @property int|null $is_builder Испольнитель
 * @property int|null $new_message Новое сообщение
 * @property int|null $task_actions Действие по заданию
 * @property int|null $new_review Новый отзыв
 * @property int|null $show_my_contacts Показывать мои контакты только заказчику
 * @property int|null $not_show_my_profile Не показывать мой профиль
 *
 * @property Favorites[] $favorites
 * @property Favorites[] $favorites0
 * @property Messages[] $messages
 * @property Opinions[] $opinions
 * @property Opinions[] $opinions0
 * @property Photos[] $photos
 * @property Responses[] $responses
 * @property Tasks[] $tasks
 * @property Tasks[] $tasks0
 * @property Cities $city
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'login', 'password', 'city_id'], 'required'],
            [['date_add', 'birthday', 'last_activity'], 'safe'],
            [['city_id', 'is_builder', 'new_message', 'task_actions', 'new_review', 'show_my_contacts', 'not_show_my_profile'], 'integer'],
            [['about_me'], 'string'],
            [['raiting'], 'number'],
            [['email'], 'string', 'max' => 320],
            [['login', 'avatar'], 'string', 'max' => 70],
            [['password'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 11],
            [['skype', 'telegram'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Электронная почта',
            'login' => 'Логин',
            'password' => 'Пароль',
            'date_add' => 'Дата регистрации',
            'city_id' => 'id населенного пугкта',
            'avatar' => 'Аватар',
            'birthday' => 'Дата рождения',
            'about_me' => 'О пользователе',
            'phone' => 'Телефон',
            'skype' => 'Skype',
            'telegram' => 'Telegram',
            'raiting' => 'Рейтинг',
            'last_activity' => 'Дата последней активности',
            'is_builder' => 'Испольнитель',
            'new_message' => 'Новое сообщение',
            'task_actions' => 'Действие по заданию',
            'new_review' => 'Новый отзыв',
            'show_my_contacts' => 'Показывать мои контакты только заказчику',
            'not_show_my_profile' => 'Не показывать мой профиль',
        ];
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['user_id_customer' => 'id']);
    }

    /**
     * Gets query for [[Favorites0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites0()
    {
        return $this->hasMany(Favorites::className(), ['user_id_builder' => 'id']);
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Opinions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions()
    {
        return $this->hasMany(Opinions::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Opinions0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOpinions0()
    {
        return $this->hasMany(Opinions::className(), ['review_author_id' => 'id']);
    }

    /**
     * Gets query for [[Photos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Responses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResponses()
    {
        return $this->hasMany(Responses::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasMany(Tasks::className(), ['customer_id' => 'id']);
    }

    /**
     * Gets query for [[Tasks0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTasks0()
    {
        return $this->hasMany(Tasks::className(), ['builder_id' => 'id']);
    }

    /**
     * Gets query for [[City]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }
}
