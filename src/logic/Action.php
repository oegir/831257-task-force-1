<?php

namespace TaskForce\logic;

/**
 * Класс для описания действия над объектом
 *
 */
abstract class Action
{
    abstract public function getActionName();

    abstract public function getActionInternalName();

    abstract public function isAvailable($id_user, $id_customer, $id_builder);
}
