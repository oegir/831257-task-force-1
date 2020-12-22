<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия respond Откликнуться
 *
 */
class ActionRespond extends Action
{
    public function getName() : string
    {
        return 'Откликнуться';
    }

    public function getInternalName() : string
    {
        return Task::ACTION_RESPOND;
    }

    public function isAvailable(int $id_user, int $id_customer, int $id_builder) : bool
    {
        return $id_user === $id_builder;
    }
}
