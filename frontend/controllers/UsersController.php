<?php

namespace frontend\controllers;

use yii\web\Controller;
use frontend\models\Users;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $builders = Users::find()
        ->where(['is_builder' => 1])
        ->orderBy('date_add')
        ->all();

        return $this->render('index', ['builders' => $builders]);
    }
}
