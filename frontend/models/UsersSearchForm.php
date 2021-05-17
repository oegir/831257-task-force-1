<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Класс формы фильтрации для списка новых задач
 *
 */
class UsersSearchForm extends Model
{
    /**
     * @var string $categories_check Массив категорий, ключ - id категории, значение - наименование категории
     */
    public $categories_check;

    /**
     * @var string $free Сейчас свободен
     */
    public $free;

    /**
     * @var string $online Сейчас онлайн
     */
    public $online;

    /**
     * @var string $reviews Есть отзывы
     */

    public $reviews;

    /**
     * @var string $chosen В избранном
     */
    public $chosen;

    /**
     * @var string $search Строка поиска
     */
    public $search;

    /**
     * Присвоение значений по умолчанию полям фильтра
     *
     */
    public function rules()
    {
        return [
            ['categories_check', 'default', 'value' => []],
            ['free', 'default', 'value' => 0],
            ['online', 'default', 'value' => 0],
            ['reviews', 'default', 'value' => 0],
            ['chosen', 'default', 'value' => 0],
            ['search', 'default', 'value' => ''],
        ];
    }
}
