<?php

namespace TaskForce\date;

/**
 * Класс для определения времени между двумя датами
 *
 * @property string $date1 Дата начала периода
 * @property string $date2 Дата окончания периода, по умолчанию текущая дата
 * @property object $dateStart Объект класса DateTime
 * @property object $dateEnd Объект класса DateTime
 * @property object $dateDiff Объект класса DateInterval
 */
class DateInterval
{
    public $date1;
    public $date2;

    private $dateStart;
    private $dateEnd;
    private $dateDiff;

    public function __construct(string $date1, string $date2 = '')
    {
        $this->dateStart = new \DateTime($date1);
        $this->dateEnd = new \DateTime($date2);
        $this->dateDiff = $this->dateStart->diff($this->dateEnd);
    }

    public function getInterval() : string
    {
        if ($this->dateDiff->y > 0) {
            $interval = $this->dateDiff->y . " " . $this->getNounPlural($this->dateDiff->y, "год", "года", "лет");
        } elseif ($this->dateDiff->m > 0) {
            $interval = $this->dateDiff->m . " " . $this->getNounPlural($this->dateDiff->m, "месяц", "месяца", "месяцев");
        } elseif ($this->dateDiff->d > 0) {
            $interval = $this->dateDiff->d . " " . $this->getNounPlural($this->dateDiff->d, "день", "дня", "дней");
        } elseif ($this->dateDiff->h > 0) {
            $interval = $this->dateDiff->h . " " . $this->getNounPlural($this->dateDiff->h, "час", "часа", "часов");
        } elseif ($this->dateDiff->i > 0) {
            $interval = $this->dateDiff->i . " " . $this->getNounPlural($this->dateDiff->i, "минута", "минуты", "минут");
        } elseif ($this->dateDiff->s > 0) {
            $interval = $this->dateDiff->s . " " . $this->getNounPlural($this->dateDiff->s, "секунда", "секунды", "секунд");
        } else {
            $interval = '';
        }

        return $interval;
    }

    /**
    * Возвращает корректную форму множественного числа
    * Ограничения: только для целых чисел
    *
    * Пример использования:
    * $remaining_minutes = 5;
    * echo "Я поставил таймер на {$remaining_minutes} " .
    *     get_noun_plural_form(
    *         $remaining_minutes,
    *         'минута',
    *         'минуты',
    *         'минут'
    *     );
    * Результат: "Я поставил таймер на 5 минут"
    *
    * @param int $number Число, по которому вычисляем форму множественного числа
    * @param string $one Форма единственного числа: яблоко, час, минута
    * @param string $two Форма множественного числа для 2, 3, 4: яблока, часа, минуты
    * @param string $many Форма множественного числа для остальных чисел
    *
    * @return string Рассчитанная форма множественнго числа
    */
    private function getNounPlural(int $number, string $one, string $two, string $many): string
    {
        $number = (int)$number;
        $mod10 = $number % 10;
        $mod100 = $number % 100;

        switch (true) {
            case ($mod100 >= 11 && $mod100 <= 20):
                return $many;

            case ($mod10 > 5):
                return $many;

            case ($mod10 === 1):
                return $one;

            case ($mod10 >= 2 && $mod10 <= 4):
                return $two;

            default:
                return $many;
        }
    }
}
