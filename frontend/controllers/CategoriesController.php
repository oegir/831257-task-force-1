<?php

namespace frontend\controllers;

use frontend\models\Categories;
use yii\web\Controller;

class CategoriesController extends Controller
{
    public function actionIndex()
    {
        $cat = new Categories();
        $cat->category = "Test";
        $cat->icon = "test";

        // сохранение модели в базе данных
        $cat->save();
        return $this->render('index');
    }
}
