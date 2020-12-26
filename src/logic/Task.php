<?php

namespace TaskForce\logic;

use TaskForce\ex\TaskArgumentsExeption;

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
    private $id_customer;

    /**
     * @var int $id_builder id исполнителя
     */
    private $id_builder;

    public function __construct(int $id_customer, int $id_builder)
    {
        $this->id_customer = $id_customer;
        $this->id_builder = $id_builder;
    }

    /**
     * Возврат «карты» статусов
     *
     * @return array
     */
    public static function getStatusesMap() : array
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
    public static function getActionsMap() : array
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
     * @return string
     */
    public function getNextStatus( string $action) : string
    {
        if (!self::validateAction($action)) {
            throw new TaskArgumentsExeption("Задано некорректное действие над заданием");
        }
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
    }

    /**
     * Вернуть доступное действие для указанного статуса
     *
     * @param string $status  Cтатус объекта
     * @param int    $id_user id пользователя, совершающего действие над объектом
     *
     * @return Action Объект-действие
     */
    public function getAvaliableAction(string $status, int $id_user) : Action
    {
        if (!self::validateStatus($status)) {
            throw new TaskArgumentsExeption("Задан некорректный статус задания");
        }
        if (!$this->validateUser($id_user)) {
            throw new TaskArgumentsExeption("Указан некорректный id пользователя");
        }

        if ($status === self::STATUS_NEW) {
            $obj = new ActionCancel();
            if ($obj->isAvailable($id_user, $this->id_customer, $this->id_builder)) {
                return $obj;
            }
            unset($obj);

            $obj = new ActionRespond();
            if ($obj->isAvailable($id_user, $this->id_customer, $this->id_builder)) {
                return $obj;
            }
        }
        if ($status === self::STATUS_WORK) {
            $obj = new ActionComplete();
            if ($obj->isAvailable($id_user, $this->id_customer, $this->id_builder)) {
                return $obj;
            }
            unset($obj);

            $obj = new ActionRefuse();
            if ($obj->isAvailable($id_user, $this->id_customer, $this->id_builder)) {
                return $obj;
            }
        }
    }

    /**
     * Проверка корректности действия над заданием
     *
     * @param string $action Действие над заданием
     *
     * @return bool
     */
    private static function validateAction(string $action) : bool
    {
        return array_key_exists($action, self::getActionsMap());
    }

    /**
     * Проверка корректности статуса задания
     *
     * @param string $status  Cтатус задания
     *
     * @return bool
     */
    private static function validateStatus(string $status) : bool
    {
        return array_key_exists($status, self::getStatusesMap());
    }

    /**
     * Проверка корректности id пользователя
     *
     * @param int $id_user id пользователя
     *
     * @return bool
     */
    private function validateUser(int $id_user) : bool
    {
        return ($id_user === $this->id_customer || $id_user === $this->id_builder);
    }
}
