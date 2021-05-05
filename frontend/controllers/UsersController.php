<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use frontend\models\Users;
use frontend\models\Tasks;
use frontend\models\Categories;
use frontend\models\UsersSearchForm;
use TaskForce\logic\TaskLogic;

class UsersController extends Controller
{
    public function actionIndex()
    {
        //список категорий
        $cats = Categories::find()->all();

        $model_form = new UsersSearchForm();

        if (!Yii::$app->request->getIsPost()) {
            $model_form->categories_check = Categories::getCategoriesCheck();
        }

        $model_form->validate();

        $model_form->load(Yii::$app->request->post());

        //формирование запроса
        $query = Users::find()
        ->joinWith('categories')
        ->where(['is_builder' => 1])
        ;

        //фильтр Сейчас свободен
        if ($model_form->free) {

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
        if ($model_form->online) {
            $query->andWhere('last_activity > DATE_SUB(UTC_TIMESTAMP(), INTERVAL 30 MINUTE)');
        }

        //фильтр Есть отзывы
        if ($model_form->reviews) {
            $query->andWhere(['>', "opinions_count", 0]);
        }

        //фильтр Сейчас В избранном
        // не могу сделать пока не сделана авторизация

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

        //строка поиска
        $query->andFilterWhere(['like', 'login', $model_form->search])  ;

        $query->orderBy('date_add');

        $builders = $query->all();

        return $this->render('index', ['builders' => $builders, 'model' => $model_form, 'cats' => $cats]);
    }

}
