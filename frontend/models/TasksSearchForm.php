<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Класс формы фильтрации для списка новых задач
 *
 */
class TasksSearchForm extends Model
{
    /**
     * @var string $categories_check Массив категорий, ключ - id категории, значение - наименование категории
     */
    public $categories_check;

    /**
     * @var string $nobuilder Без исполнителя
     */
    public $nobuilder;

    /**
     * @var string $remote_work Удаленная работа
     */
    public $remote_work;

    /**
     * @var string $period Массив из временных промежутков для выбора периода просмотра задач
     */
    public $period;

    /**
     * @var string $period_index Индех массива из временных промежутков
     */
    public $period_index;

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
            ['nobuilder', 'default', 'value' => 0],
            ['remote_work', 'default', 'value' => 0],
            ['period', 'default', 'value' => [1 => 'За день', 2 => 'За неделю', 3 => 'За месяц', 4 => 'За все время']],
            ['period_index', 'default', 'value' => 4],
            ['search', 'default', 'value' => ''],
        ];
    }

    /**
     * Получить количество дней для фильтрации заданий по периоду
     *
     */
    public function getPeriodDays()
    {
        switch ($this->period_index) {
            case '1':
                $days = 1;
                break;
            case '2':
                $days = 7;
                break;
            case '3':
                $days = 30;
                break;
            default:
                $days = 0;
                break;
        }
        return $days;
    }

}
