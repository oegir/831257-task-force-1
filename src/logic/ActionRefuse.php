<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия refuse Отказаться
 *
 */
class ActionRefuse extends Action
{
    public function getName() : string
    {
        return 'Отказаться';
    }

    public function getInternalName() : string
    {
        return Task::ACTION_REFUSE;
    }

    public function isAvailable(int $id_user, int $id_customer, int $id_builder) : bool
    {
        return $id_user === $id_builder;
    }
}
