<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия refuse Отказаться
 *
 */
class ActionRefuse extends Action
{
    public function getActionName()
    {
        return 'Отказаться';
    }

    public function getActionInternalName()
    {
        return 'refuse';
    }

    public function isAvailable($id_user, $id_customer, $id_builder)
    {
        return $id_user === $id_builder;
    }
}
