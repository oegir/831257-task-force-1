<?php

namespace TaskForce\logic;

class Task
{
    const STATUS_NEW = 'new';
    const STATUS_CANCELED = 'canceled';
    const STATUS_WORK = 'work';
    const STATUS_DONE = 'done';
    const STATUS_FAILED = 'failed';

    const ACTION_CANCEL = 'cancel';
    const ACTION_COMPLETE = 'complete';
    const ACTION_RESPOND = 'respond';
    const ACTION_REFUSE = 'refuse';

    public $status;

    private $id_customer;
    private $id_builder;


    public function __construct($id_customer, $id_builder)
    {
        $this->id_customer = $id_customer;
        $this->id_builder = $id_builder;
    }

//класс имеет методы для возврата «карты» статусов и действий.

public function getStatusesMap()
{
    return [
        self::STATUS_NEW => 'Новое',
        self::STATUS_CANCELED => 'Отменено',
        self::STATUS_WORK => 'В работе',
        self::STATUS_DONE => 'Выполнено',
        self::STATUS_FAILED => 'Провалено'
    ];
}

public function getActionsMap()
{
    return [
        self::ACTION_CANCEL => 'Отмененить',
        self::ACTION_COMPLETE => 'Выполнено',
        self::ACTION_RESPOND => 'Откликнуться',
        self::ACTION_REFUSE => 'Отказаться'
    ];
}

//класс имеет метод для получения статуса, в которой он перейдёт после выполнения указанного действия

    public function getNextStatus($action)
    {
        if ($action === self::ACTION_CANCEL) {
            return self::STATUS_CANCELED;
        }
        if ($action === self::ACTION_COMPLETE) {
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

    public function getAvaliableAction($status, $id_user)
    {
        if ($status === self::STATUS_NEW) {
            if ($id_user === $this->id_customer) {
                return self::ACTION_CANCEL;
            }
            if ($id_user === $this->id_builder) {
                return self::ACTION_RESPOND;
            }
            return null;
        }
        if ($status === self::STATUS_WORK) {
            if ($id_user === $this->id_customer) {
                return self::ACTION_COMPLETE;
            }
            if ($id_user === $this->id_builder) {
                return self::ACTION_REFUSE;
            }
            return null;
        }
        return null;
    }
}
