<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Tasks;
use TaskForce\logic\TaskLogic;

class TasksController extends Controller
{
    public function actionIndex()
    {
        $tasks = Tasks::find()
        ->joinWith('categories')
        ->where(['status' => TaskLogic::STATUS_NEW])
        ->orderBy('date_add')
        ->all();

        return $this->render('index', ['tasks' => $tasks]);
    }
}
