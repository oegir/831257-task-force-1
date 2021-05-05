<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Tasks;
use frontend\models\Categories;
use frontend\models\TasksSearchForm;
use TaskForce\logic\TaskLogic;

class TasksController extends Controller
{
    public function actionIndex()
    {
        //список категорий
        $cats = Categories::find()->all();

        $model_form = new TasksSearchForm();

        //формирование массива категорий вида ['id категории' => 'наименовани категории', ...]
        if (!Yii::$app->request->getIsPost()) {
            $model_form->categories_check = Categories::getCategoriesCheck();
        }
        $model_form->validate();

        $model_form->load(Yii::$app->request->post());

        //формирование запроса
        $query = Tasks::find()
        ->joinWith('category')
        ->joinWith('responses')
        ->where(['status' => TaskLogic::STATUS_NEW]);

        //фильтр Без исполнителя
        if ($model_form->nobuilder) {
            // нет записей в таблице 'responses' для этой задачи
            $query->andWhere(['cost' => null]);
        }
        //фильтр Удаленная работа
        if ($model_form->remote_work) {
            $query->andWhere(['latitude' => null]);
        }
        //фильтр Категории
        $arr = ['or'];
        foreach ($model_form->categories_check as $key => $value) {
            if ($value) {
                $arr[] = "category_id=".$key;
            }
        }
        if (count($arr) > 1) {
            $query->andWhere($arr);
        }

        //фильтр Период
        if ($model_form->period_index != '4') {
            $query->andWhere(['<=', "TO_DAYS(CURRENT_TIMESTAMP) - TO_DAYS(tasks.date_add)", $model_form->getPeriodDays()]);
        }
        //строка поиска
        $query->andFilterWhere(['like', 'job', $model_form->search])  ;

        $query->orderBy('date_add');

        $tasks = $query->all();

        return $this->render('index', ['tasks' => $tasks, 'model' => $model_form, 'cats' => $cats]);
    }
}
