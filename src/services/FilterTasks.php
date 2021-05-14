<?php

namespace TaskForce\services;

use Yii;
use yii\db\Query;
use frontend\models\TasksSearchForm;

/**
 * Класс для составления фильтра для запроса к БД
 *
 */
class FilterTasks
{
    /**
     * Вернуть объект запроса с добавленными условиями
     *
     * @param TasksSearchForm $form объект модели TasksSearchForm
     * @param Query $query id объект запроса
     *
     * @return Query измененный объект запроса
     */
    public static function getQuery(TasksSearchForm $form, Query $query) : Query
    {
        //фильтр Без исполнителя
        if ($form->nobuilder) {
            // нет записей в таблице 'responses' для этой задачи
            $query->andWhere(['cost' => null]);
        }
        //фильтр Удаленная работа
        if ($form->remote_work) {
            $query->andWhere(['latitude' => null]);
        }
        //фильтр Категории
        if (Yii::$app->request->getIsPost()) {

            if ($form->categories_check) {
                $query->andWhere(['in','category_id', $form->categories_check]);
            }
        }
        //фильтр Период
        if ($form->period_index != TasksSearchForm::PERIOD_INDEX_ALL) {
            $query->andWhere(['<=', "TO_DAYS(CURRENT_TIMESTAMP) - TO_DAYS(tasks.date_add)", $form->getPeriodDays()]);
        }
        //строка поиска
        $query->andFilterWhere(['like', 'job', $form->search])  ;

        return $query;
    }
}
