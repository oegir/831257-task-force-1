<?php
    use \yii\helpers\Html;
?>

<section class="content-view">
  <div class="user__card-wrapper">
    <div class="user__card">
      <?= HTml::img('@imgPath/'.$user->avatar, ['width'=>"120", 'height'=>"120"]); ?>
      <div class="content-view__headline">
        <?= HTml::tag('h1', $user->login); ?>
        <?= HTml::tag('p', $user->city->city.', '.
                  Yii::t(
                          'app',
                          '{n, plural, one{# год} few{# года} many{# лет} other{ОШИБКА}}',
                          ['n' => $user->getAge()]
                         )
                     );
        ?>
        <div class="profile-mini__name five-stars__rate">
          <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
          <?= HTml::tag('b', is_null($user->raiting) ? '0' : $user->raiting); ?>
        </div>
        <?= HTml::tag('b', 'Выполнил '.
                  Yii::t(
                          'app',
                          '{n, plural, =0{# заданий} =1{# задание} one{# задание} few{# задания} many{# заданий} other{ОШИБКА}}',
                          ['n' => $user->tasks_count]
                         ),
                      ['class'=>"done-task"]
                     );
        ?>
        <?= HTml::tag('b', 'Получил '.
                  Yii::t(
                          'app',
                          '{n, plural, =0{# отзывов} =1{# отзыв} one{# отзыв} few{# отзывова} many{# отзывов} other{ОШИБКА}}',
                          ['n' => $user->tasks_count]
                         ),
                      ['class'=>"done-eview"]
                     );
        ?>
      </div>
      <div class="content-view__headline user__card-bookmark user__card-bookmark--current">
        <?= HTml::tag('span', 'Был на сайте '.$user->getPeriodLastVizit()); ?>
        <a href="#"><b></b></a>
      </div>
    </div>
    <div class="content-view__description">
      <?= HTml::tag('p', $user->about_me); ?>
    </div>
    <div class="user__card-general-information">
      <div class="user__card-info">
        <h3 class="content-view__h3">Специализации</h3>
        <div class="link-specialization">
          <?php foreach ($user->skills as $skill) { ?>
            <?= HTml::tag('a', $skill->category->category, ['class'=>"link-regular", 'href'=>"#"]); ?>
          <?php } ?>
        </div>
        <h3 class="content-view__h3">Контакты</h3>
        <div class="user__card-link">
          <?= HTml::tag('a', $user->phone, ['class'=>"user__card-link--tel link-regular", 'href'=>"#"]); ?>
          <?= HTml::tag('a', $user->email, ['class'=>"user__card-link--email link-regular", 'href'=>"#"]); ?>
          <?= HTml::tag('a', $user->skype, ['class'=>"user__card-link--skype link-regular", 'href'=>"#"]); ?>
        </div>
      </div>
      <div class="user__card-photo">
        <h3 class="content-view__h3">Фото работ</h3>
        <?php foreach ($user->photos as $photo) {; ?>
          <?= HTml::tag('a',
                        HTml::img('@imgPath/'.$photo->name, ['width'=>"85", 'height'=>"86", 'alt'=>"Фото работы"]),
                        ['href'=>Yii::getAlias('@imgPath').'/'.$photo->name]);
          ?>
        <?php } ?>
      </div>
    </div>
  </div>

  <?php if ($user->opinions_count > 0) { ?>
    <div class="content-view__feedback">
      <?= HTml::tag('h2', 'Отзывы<span>('.$user->opinions_count.')</span>')?>
      <div class="content-view__feedback-wrapper reviews-wrapper">
        <?php foreach ($user->opinions as $opinion) { ?>
          <div class="feedback-card__reviews">
            <p class="link-task link">Задание
              <?= HTml::tag('a', $opinion->task->job, ['class'=>"link-regular", 'href'=>"/task/".$opinion->task->id]); ?>
            </p>
            <div class="card__review">
              <a href="#">
                <?= HTml::img('@imgPath/'. $opinion->reviewAuthor->avatar, ['width'=>"55", 'height'=>"56"]); ?>
              </a>
              <div class="feedback-card__reviews-content">
                <p class="link-name link">
                  <?= HTml::tag('a', $opinion->reviewAuthor->login, ['class'=>"link-regular", 'href'=>"/user/".$opinion->reviewAuthor->id]); ?>
                </p>
                <?= HTml::tag('p', $opinion->description, ['class'=>"review-text"]); ?>
              </div>
              <div class="card__review-rate">
                <?= HTml::tag('p', $opinion->rating.'<span></span>', ['class'=>"five-rate big-rate"]); ?>
              </div>
          </div>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

</section>

<section class="connect-desk">
  <div class="connect-desk__chat">

  </div>
</section>
