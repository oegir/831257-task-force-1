<?php

namespace frontend\models;

use yii\base\Model;

/**
 * Класс формы фильтрации для списка новых задач
 *
 */
class TasksSearchForm extends Model
{
    const PERIOD_INDEX_DAY = 1;
    const PERIOD_INDEX_WEEK = 2;
    const PERIOD_INDEX_MONTH = 3;
    const PERIOD_INDEX_ALL = 4;

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
            ['period', 'default', 'value' => self::getPeriods()],
            ['period_index', 'default', 'value' => self::PERIOD_INDEX_ALL],
            ['search', 'default', 'value' => ''],
        ];
    }

    /**
     * Получить количество дней для фильтрации заданий по периоду
     *
     */
    public function getPeriodDays() : int
    {
        switch ($this->period_index) {
            case self::PERIOD_INDEX_DAY:
                $days = 1;
                break;
            case self::PERIOD_INDEX_WEEK:
                $days = 7;
                break;
            case self::PERIOD_INDEX_MONTH:
                $days = 30;
                break;
            default:
                $days = 0;
                break;
        }
        return $days;
    }

    /**
     * Получить массив возможных периодов для фильра
     *
     */
    private function getPeriods() : array
    {
        return [
            self::PERIOD_INDEX_DAY => 'За день',
            self::PERIOD_INDEX_WEEK => 'За неделю',
            self::PERIOD_INDEX_MONTH => 'За месяц',
            self::PERIOD_INDEX_ALL => 'За все время'
        ];
    }
}
