<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия Cancel Отменить
 *
 */
class ActionCancel extends Action
{
    public function getName() : string
    {
        return 'Отмененить';
    }

    public function getInternalName() : string
    {
        return Task::ACTION_CANCEL;
    }

    public function isAvailable(int $id_user, int $id_customer, int $id_builder) : bool
    {
        return $id_user === $id_customer;
    }
}
