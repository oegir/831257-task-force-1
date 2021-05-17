<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\Users;
use frontend\models\Categories;
use frontend\models\UsersSearchForm;
use TaskForce\services\FilterUsers;


class UsersController extends Controller
{
    public function actionIndex()
    {
        //список категорий
        $cats = Categories::getCategoriesList();

        $model_form = new UsersSearchForm();

        $model_form->validate();

        $model_form->load(Yii::$app->request->post());

        //формирование запроса
        $query = Users::find()
        ->joinWith('categories')
        ->where(['is_builder' => 1]);

        //добавление фильтров
        $query = FilterUsers::getQuery($model_form, $query);

        $query->orderBy('date_add');

        $builders = $query->all();

        return $this->render('index', ['builders' => $builders, 'model' => $model_form, 'cats' => $cats]);
    }
}
