<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Tasks;
use frontend\models\Categories;
use frontend\models\TasksSearchForm;
use TaskForce\logic\TaskLogic;
use TaskForce\services\FilterTasks;

class TasksController extends Controller
{
    public function actionIndex()
    {
        //список категорий
        $cats = Categories::getCategoriesList();

        $model_form = new TasksSearchForm();

        $model_form->validate();

        $model_form->load(Yii::$app->request->post());

        //формирование запроса
        $query = Tasks::find()
        ->joinWith('category')
        ->joinWith('responses')
        ->where(['status' => TaskLogic::STATUS_NEW]);

        //добавление фильтров
        $query = FilterTasks::getQuery($model_form, $query);

        $query->orderBy('date_add');

        $tasks = $query->all();

        return $this->render('index', ['tasks' => $tasks, 'model' => $model_form, 'cats' => $cats]);
    }
}
