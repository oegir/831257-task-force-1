<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия respond Откликнуться
 *
 */
class ActionRespond extends Action
{
    public function getActionName()
    {
        return 'Откликнуться';
    }

    public function getActionInternalName()
    {
        return 'respond';
    }

    public function isAvailable($id_user, $id_customer, $id_builder)
    {
        return $id_user === $id_builder;
    }
}
