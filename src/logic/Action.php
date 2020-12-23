<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия над объектом
 *
 */
abstract class Action
{
    /**
     * Вернуть имя действия
     * пример: 'Отмененить'
     *
     * @return string
     */
    abstract public function getName() : string;

    /**
     * Вернуть внутреннее имя действия
     * пример: 'cancel'
     *
     * @return string
     */
    abstract public function getInternalName() : string;

    /**
     * Проверка доступности действия для указанного пользователя
     *
     * @param int $id_user     id пользователя, совершающего действие над объектом
     * @param int $id_customer id заказчика
     * @param int $id_builder  id исполнителя
     *
     * @return bool
     */
    abstract public function isAvailable(int $id_user, int $id_customer, int $id_builder) : bool;
}
