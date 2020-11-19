<?php

//namespace TaskForce\classes;

class Task
{
//в виде констант в классе должны быть перечислены все возможные действия и статусы
    const STATUS_NEW = 'Новое';
    const STATUS_CANCELED = 'Отменено';
    const STATUS_WORK = 'В работе';
    const STATUS_DONE = 'Выполнено';
    const STATUS_FAILED = 'Провалено';

    const ACTION_CANCEL = 'Отмененить';
    const ACTION_ACCEPT = 'Выполнено';
    const ACTION_RESPOND = 'Откликнуться';
    const ACTION_REFUSE = 'Отказаться';

    public $status;

//во внутренних свойствах класс хранит id исполнителя и id заказчика. Эти значения класс получает в своём конструкторе.
    private $id_customer;
    private $id_builder;


    public function __construct($id_customer, $id_builder, $status)
    {
        $this->id_customer = $id_customer;
        $this->id_builder = $id_builder;
        $this->status = $status;
    }

//класс имеет методы для возврата «карты» статусов и действий. Карта — это ассоциативный массив, где ключ — внутреннее имя, а значение — названия статуса/действия на русском.
//
// не понял что хотят получать. Список всех констант ?


//класс имеет метод для получения статуса, в которой он перейдёт после выполнения указанного действия

    public function getNextStatus($action)
    {
        if ($action === self::ACTION_CANCEL) {
            return self::STATUS_CANCELED;
        }
        if ($action === self::ACTION_ACCEPT) {
            return self::STATUS_DONE;
        }
        if ($action === self::ACTION_RESPOND) {
            return self::STATUS_WORK;
        }
        if ($action === self::ACTION_REFUSE) {
            return self::STATUS_FAILED;
        }
        return null;
    }

//класс имеет метод для получения доступных действий для указанного статуса
//
// указанного статуса или всё же текущего для объекта ???

    public function getAvaliableAction($id_user)
    {
        if ($this->status === self::STATUS_NEW) {
            if ($id_user === $this->id_customer) {
                return self::ACTION_CANCEL;
            }
            if ($id_user === $this->id_builder) {
                return self::ACTION_RESPOND;
            }
            return null;
        }
        if ($this->status === self::STATUS_WORK) {
            if ($id_user === $this->id_customer) {
                return self::ACTION_ACCEPT;
            }
            if ($id_user === $this->id_builder) {
                return self::ACTION_REFUSE;
            }
            return null;
        }
        return null;
    }
}
