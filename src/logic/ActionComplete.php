<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия complete Выполнено
 *
 */
class ActionComplete extends Action
{
    public function getName() : string
    {
        return 'Выполнено';
    }

    public function getInternalName() : string
    {
        return Task::ACTION_COMPLETE;
    }

    public function isAvailable(int $id_user, int $id_customer, int $id_builder) : bool
    {
        return $id_user === $id_customer;
    }
}
