<?php

namespace TaskForce\services;

use Yii;
use yii\db\Query;
use yii\helpers\ArrayHelper;
use TaskForce\logic\TaskLogic;
use frontend\models\Tasks;
use frontend\models\UsersSearchForm;

/**
 * Класс для составления фильтра для запроса к БД
 *
 */
class FilterUsers
{
    /**
     * Вернуть объект запроса с добавленными условиями
     *
     * @param UsersSearchForm $form объект модели UsersSearchForm
     * @param Query $query id объект запроса
     *
     * @return Query измененный объект запроса
     */
    public static function getQuery(UsersSearchForm $form, Query $query) : Query
    {
        //фильтр Сейчас свободен
        if ($form->free) {

            //выборка id исполнителей с задачами в работе
            $subQuery = Tasks::find()
            ->select('builder_id')
            ->distinct()
            ->where(['status' => TaskLogic::STATUS_WORK])
            ->all();

            $ids = ArrayHelper::getColumn($subQuery, 'builder_id');

            $query->andWhere(['not in', 'users.id', $ids]);
        }
        //фильтр Сейчас онлайн
        //в БД дата хранится в UTC
        if ($form->online) {
            $query->andWhere('last_activity > DATE_SUB(UTC_TIMESTAMP(), INTERVAL 30 MINUTE)');
        }
        //фильтр Есть отзывы
        if ($form->reviews) {
            $query->andWhere(['>', "opinions_count", 0]);
        }
        //фильтр Сейчас В избранном
        // не могу сделать пока не сделана авторизация

        //фильтр Категории
        if (Yii::$app->request->getIsPost()) {

            if ($form->categories_check) {
                $query->andWhere(['in','category_id', $form->categories_check]);
            }
        }
        //строка поиска
        $query->andFilterWhere(['like', 'login', $form->search])  ;

        return $query;
    }
}
