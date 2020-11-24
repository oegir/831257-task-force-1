<?php

namespace TaskForce\logic;

/**
 * Класс для описания бизнес-логики биржи объявлений
 *
 */
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

    /**
     * @var string $status Статус объекта
     */
    public $status;

    /**
     * @var int $id_customer id заказчика
     */
    private int $id_customer;

    /**
     * @var int $id_builder id исполнителя
     */
    private int $id_builder;

    public function __construct($id_customer, $id_builder)
    {
        $this->id_customer = $id_customer;
        $this->id_builder = $id_builder;
    }

    /**
     * Возврат «карты» статусов
     *
     * @return array
     */
    public function getStatusesMap() : array
    {
        return [
            self::STATUS_NEW => 'Новое',
            self::STATUS_CANCELED => 'Отменено',
            self::STATUS_WORK => 'В работе',
            self::STATUS_DONE => 'Выполнено',
            self::STATUS_FAILED => 'Провалено'
        ];
    }

    /**
     * Возврат «карты» действий
     *
     * @return array
     */
    public function getActionsMap() : array
    {
        return [
            self::ACTION_CANCEL => 'Отмененить',
            self::ACTION_COMPLETE => 'Выполнено',
            self::ACTION_RESPOND => 'Откликнуться',
            self::ACTION_REFUSE => 'Отказаться'
        ];
    }

    /**
     * Вернуть следующий статус объекта
     *
     * @param string $action Действие над объектом
     *
     * @return string|null
     */
    public function getNextStatus( string $action) : ?string
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

    /**
     * Вернуть доступное действие для указанного статуса
     *
     * @param string $status  Cтатус объекта
     * @param int    $id_user id пользователя, совершившающего действие над объектом
     *
     * @return string|null
     */
    public function getAvaliableAction(string $status, int $id_user) : ?string
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
