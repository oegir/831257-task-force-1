<?php
    use \yii\helpers\Html;
?>
<section class="content-view">
  <div class="content-view__card">
    <div class="content-view__card-wrapper">
      <div class="content-view__header">
        <div class="content-view__headline">
          <h1><?= $task->job; ?></h1>
          <span>Размещено в категории
            <?= HTml::tag('a', $task->category->category, ['class'=>"link-regular", 'href'=>"#"])?>
            <?= $task->getPeriodCreate(); ?>
          </span>
        </div>
        <?php $cat = $task->category->icon;?>
        <?= HTml::tag('b', $task->budget.'<b> ₽</b>', ['class'=>"new-task__price new-task__price--".$cat." content-view-price"])?>
        <?= HTml::tag('div', '', ['class'=>"new-task__icon new-task__icon--".$cat." content-view-icon"])?>
      </div>
      <div class="content-view__description">
        <h3 class="content-view__h3">Общее описание</h3>
        <?= HTml::tag('p', $task->description) ?>
      </div>
      <div class="content-view__attach">
        <h3 class="content-view__h3">Вложения</h3>
        <?php foreach ($task->files as $file) { ?>
          <?= HTml::tag('a', $file->name, ['href'=>"#"]); ?>
        <?php } ?>
      </div>

      <div class="content-view__location">
        <h3 class="content-view__h3">Расположение</h3>
        <div class="content-view__location-wrapper">
          <div class="content-view__map">
            <a href="#"><img src="./img/map.jpg" width="361" height="292"
                             alt="Москва, Новый арбат, 23 к. 1"></a>
          </div>
          <div class="content-view__address">
            <span class="address__town">Москва</span><br>
            <span>Новый арбат, 23 к. 1</span>
            <p>Вход под арку, код домофона 1122</p>
          </div>
        </div>
      </div>

    </div>
    <div class="content-view__action-buttons">
      <button class=" button button__big-color response-button open-modal"
              type="button" data-for="response-form">Откликнуться
      </button>
      <button class="button button__big-color refusal-button open-modal"
              type="button" data-for="refuse-form">Отказаться
      </button>
      <button class="button button__big-color request-button open-modal"
              type="button" data-for="complete-form">Завершить
      </button>
    </div>
  </div>

  <div class="content-view__feedback">
    <h2>Отклики <span><?= count($task->responses); ?></span></h2>
    <div class="content-view__feedback-wrapper">

      <?php foreach ($task->responses as $response) { ?>
        <div class="content-view__feedback-card">
          <div class="feedback-card__top">
            <?= HTml::tag('a',
                          HTml::img('@imgPath/'.$response->user->avatar, ['width'=>"55", 'height'=>"55"]),
                          ['href'=>'/user/'.$response->user->id]);
            ?>
            <div class="feedback-card__top--name">
              <p>
                <?= HTml::tag('a', $response->user->login, ['class'=>"link-regular", 'href'=> '/user/'.$response->user->id]); ?>
              </p>
              <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
              <?= HTml::tag('b', is_null($response->user->raiting) ? '0' : $response->user->raiting); ?>
            </div>
            <?= HTml::tag('span', $response->user->getPeriodLastVizit(), ['class'=>"new-task__time"]); ?>
          </div>
          <div class="feedback-card__content">
            <?= HTml::tag('p', $response->comment); ?>
            <?= HTml::tag('span', $response->cost." ₽"); ?>
          </div>
          <div class="feedback-card__actions">
            <a class="button__small-color response-button button"
              type="button">Подтвердить</a>
            <a class="button__small-color refusal-button button"
              type="button">Отказать</a>
          </div>
        </div>

      <?php } ?>

    </div>
  </div>
</section>

<section class="connect-desk">
  <div class="connect-desk__profile-mini">
    <div class="profile-mini__wrapper">
      <h3>Заказчик</h3>
      <div class="profile-mini__top">
        <?= HTml::img('@imgPath/'.$task->customer->avatar, ['width'=>"62", 'height'=>"62"]); ?>
        <div class="profile-mini__name five-stars__rate">
          <?= HTml::tag('p', $task->customer->login); ?>
        </div>
      </div>
      <p class="info-customer">
        <span>
          <?= \Yii::t(
              'app',
              '{n, plural, =0{# заданий} =1{# задание} one{# задание} few{# задания} many{# заданий} other{ОШИБКА}}',
              ['n' => $task->customer->tasks_count]);
          ?>
        </span>
        <?= HTml::tag('span', $task->customer->getPeriodCreate(false).' на сайте', ['class'=>"last-"]); ?>
      </p>
      <a href="#" class="link-regular">Смотреть профиль</a>
    </div>
  </div>

  <div id="chat-container">
    <!--                    добавьте сюда атрибут task с указанием в нем id текущего задания-->
    <chat class="connect-desk__chat"></chat>
  </div>
</section>
