<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия complete Выполнено
 *
 */
class ActionComplete extends Action
{
    public function getActionName()
    {
        return 'Выполнено';
    }

    public function getActionInternalName()
    {
        return 'complete';
    }

    public function isAvailable($id_user, $id_customer, $id_builder)
    {
        return $id_user === $id_customer;
    }
}
