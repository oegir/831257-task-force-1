<section class="user__search">
    <?php foreach ($builders as $builder) { ?>
        <div class="content-view__feedback-card user__search-wrapper">
          <div class="feedback-card__top">
            <div class="user__search-icon">
              <a href="user.html"><img src="./img/man-glasses.jpg" width="65" height="65"></a>
              <span>
                <?=
                    \Yii::t('app',
                    '{n, plural, =0{# заданий} =1{# задание} one{# задание} few{# задания} many{# заданий} other{нет заданий}}',
                    ['n' => $builder->tasks_count]);
                ?>
              </span>
              <span>
                <?=
                    \Yii::t('app',
                    '{n, plural, =0{# отзывов} =1{# отзыв} one{# отзыв} few{# отзывов} many{# отзывов} other{нет отзывов}}',
                    ['n' => $builder->opinions_count]);
                ?>
              </span>
            </div>
            <div class="feedback-card__top--name user__search-card">
              <p class="link-name"><a href="user.html" class="link-regular"><?= $builder->login; ?></a></p>
              <span></span><span></span><span></span><span></span><span class="star-disabled"></span>
              <b><?= $builder->raiting; ?></b>
              <p class="user__search-content">
                <?= $builder->about_me; ?>
              </p>
            </div>
            <span class="new-task__time">Был на сайте <?= $builder->getPeriodLastVizit(); ?></span>
          </div>
          <div class="link-specialization user__search-link--bottom">
            <?php $categories = $builder->categories; ?>
            <?php foreach ($categories as $category) { ?>
                <a href="browse.html" class="link-regular"><?= $category->category; ?></a>
            <?php } ?>
          </div>
        </div>
    <?php } ?>
</section>

<section class="search-task">
    <div class="search-task__wrapper">
        <?php
            use yii\widgets\ActiveForm;

            $form = ActiveForm::begin([
                'id' => 'search_tasks_id',
                'options' => ['class' => 'search-task__form', 'name' => 'search_tasks', 'method' => 'post', 'action' => "#"]
            ]);
        ?>

          <fieldset class="search-task__categories">
            <legend>Категории</legend>

            <?php $i = 0; ?>
            <?php foreach ($model->categories_check as $key => $item) { ?>
                <div>
                <label class="checkbox__legend">
                  <?= $form->field($model, "categories_check[$key]", ['template' => "{input}"])->checkbox([
                     'class' => 'visually-hidden checkbox__input',
                     'label' => null]
                    );
                  ?>
                    <span><?= $cats[$i]->category ?></span>
                </label>
                </div>

            <?php
                    $i += 1;
                }
            ?>

          </fieldset>

          <fieldset class='search-task__categories'>
            <legend>Дополнительно</legend>
            <div>
                <label class="checkbox__legend">
                    <?= $form->field($model, 'free')->checkbox([
                        'class' => 'visually-hidden checkbox__input',
                        'label' => null]
                        ); ?>
                    <span>Сейчас свободен</span>
                </label>
            </div>
            <div>
                <label class="checkbox__legend">
                    <?= $form->field($model, 'online')->checkbox([
                        'class' => 'visually-hidden checkbox__input',
                        'label' => null]
                        ); ?>
                    <span>Сейчас онлайн</span>
                </label>
            </div>
            <div>
                <label class="checkbox__legend">
                    <?= $form->field($model, 'reviews')->checkbox([
                        'class' => 'visually-hidden checkbox__input',
                        'label' => null]
                        ); ?>
                    <span>Есть отзывы</span>
                </label>
            </div>
            <div>
                <label class="checkbox__legend">
                    <?= $form->field($model, 'chosen')->checkbox([
                        'class' => 'visually-hidden checkbox__input',
                        'label' => null]
                        ); ?>
                    <span>В избранном</span>
                </label>
            </div>
          </fieldset>

            <div class="field-container">
              <label class="search-task__name">Поиск по имени</label>

              <?= $form->field($model, 'search')->textInput([
                  'class' => "input-middle input",
                  'type' => 'text'])
                  ->label($label = false)?>

            </div>

            <button class="button" type="submit">Искать</button>

        <?php ActiveForm::end(); ?>

    </div>

</section>
