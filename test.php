<?php

require_once 'vendor/autoload.php';

use TaskForce\logic\Task;
use TaskForce\logic\ActionCancel;
use TaskForce\logic\ActionRespond;
use TaskForce\logic\ActionComplete;
use TaskForce\logic\ActionRefuse;

$Task1 = new Task(1,2);

assert($Task1->getStatusesMap() == ['new' => 'Новое',
                                    'canceled' => 'Отменено',
                                    'work' => 'В работе',
                                    'done' => 'Выполнено',
                                    'failed' => 'Провалено'
                                   ],
                                   'Warning: StatusesMap');

assert($Task1->getActionsMap() == ['cancel' => 'Отмененить',
                                   'complete' => 'Выполнено',
                                   'respond' => 'Откликнуться',
                                   'refuse' => 'Отказаться'
                                  ],
                                  'Warning: ActionsMap');

$Task1->status = Task::STATUS_NEW;

assert($Task1->getNextStatus('cancel') == Task::STATUS_CANCELED, 'Warning: cancel action');
assert($Task1->getNextStatus('respond') == Task::STATUS_WORK, 'Warning: respond action');

$Task1->status = Task::STATUS_WORK;

assert($Task1->getNextStatus('complete') == Task::STATUS_DONE, 'Warning: complete action');
assert($Task1->getNextStatus('refuse') == Task::STATUS_FAILED, 'Warning: refuse action');

$objCancel = new ActionCancel();
$objRespond = new ActionRespond();
$objComplete = new ActionComplete();
$objRefuse= new ActionRefuse();

assert($Task1->getAvaliableAction('new', 1) == $objCancel->isAvailable(1,1,2), 'Warning: cancel action');
assert($Task1->getAvaliableAction('new', 2) == $objRespond->isAvailable(2,1,2), 'Warning: respond action');

assert($Task1->getAvaliableAction('work', 1) == $objComplete->isAvailable(1,1,2), 'Warning: complete action');
assert($Task1->getAvaliableAction('work', 2) == $objRefuse->isAvailable(2,1,2), 'Warning: refuse action');
