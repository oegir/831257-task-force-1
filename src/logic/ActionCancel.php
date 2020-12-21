<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия Cancel Отменить
 *
 */
class ActionCancel extends Action
{
    public function getActionName()
    {
        return 'Отмененить';
    }

    public function getActionInternalName()
    {
        return 'cancel';
    }

    public function isAvailable($id_user, $id_customer, $id_builder)
    {
        return $id_user === $id_customer;
    }
}
