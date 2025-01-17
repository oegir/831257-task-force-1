<section class="new-task">
    <div class="new-task__wrapper">
        <h1>Новые задания</h1>
        <?php foreach ($tasks as $task) { ?>
          <div class="new-task__card">
            <div class="new-task__title">
              <a href="view.html" class="link-regular"><h2><?= $task->job; ?></h2></a>
              <a class="new-task__type link-regular" href="#"><p><?= $task->category->category; ?></p></a>
            </div>
            <div class="new-task__icon new-task__icon--<?= $task->category->icon; ?>"></div>
            <p class="new-task_description"><?= $task->description; ?></p>
            <b class="new-task__price new-task__price--translation"><?= $task->budget; ?><b> ₽</b></b>
            <p class="new-task__place"><?= $task->address; ?></p>
            <span class="new-task__time"><?= $task->getPeriodCreate(); ?></span>
          </div>
        <?php } ?>

        <div class="new-task__pagination">
          <ul class="new-task__pagination-list">
            <li class="pagination__item"><a href="#"></a></li>
            <li class="pagination__item pagination__item--current">
              <a>1</a></li>
            <li class="pagination__item"><a href="#">2</a></li>
            <li class="pagination__item"><a href="#">3</a></li>
            <li class="pagination__item"><a href="#"></a></li>
          </ul>
        </div>
    </div>
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

            <?= $form->field($model, 'categories_check', ['template' => "{input}"])->
              checkboxList($cats,
                [
                  'item' => function ($index, $label, $name, $checked, $value) {
                              return '
                                <label class="checkbox__legend">
                                  <input class="visually-hidden checkbox__input" type="checkbox" name='.$name.
                                    ' value='.$value.
                                    (($checked)?" checked":"").
                                  '>'.
                                  '<span>'.$label.'</span>
                                </label>
                              ';
                            }
                ]
              );
            ?>
        </fieldset>

          <fieldset class='search-task__categories'>
                <legend>Дополнительно</legend>
                <div>
                    <label class="checkbox__legend">
                        <?= $form->field($model, 'nobuilder')->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                            'label' => null]
                            ); ?>
                        <span>Без исполнителя</span>
                    </label>
                </div>
                <div>
                    <label class="checkbox__legend">
                        <?= $form->field($model, 'remote_work')->checkbox([
                            'class' => 'visually-hidden checkbox__input',
                            'label' => null]
                            ); ?>
                        <span>Удаленная работа</span>
                    </label>
                </div>
          </fieldset>

            <div class="field-container">
              <label class="search-task__name">Период</label>

              <?= $form->field($model, 'period_index')->dropDownList($model->period, [
                  'class' => 'multiple-select input'])
                  ->label($label = false)?>

            </div>

            <div class="field-container">
              <label class="search-task__name">Поиск по названию</label>

              <?= $form->field($model, 'search')->textInput([
                  'class' => "input-middle input",
                  'type' => 'search'])
                  ->label($label = false)?>

            </div>

            <button class="button" type="submit">Искать</button>

        <?php ActiveForm::end(); ?>

    </div>

</section>
