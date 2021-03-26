<section class="user__search">
    <?php foreach ($builders as $builder) { ?>
        <div class="content-view__feedback-card user__search-wrapper">
          <div class="feedback-card__top">
            <div class="user__search-icon">
              <a href="user.html"><img src="./img/man-glasses.jpg" width="65" height="65"></a>
              <span><?= $builder->tasks_count; ?> заданий</span>
              <span><?= $builder->opinions_count; ?> отзывов</span>
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
          <form class="search-task__form" name="users" method="post" action="#">
            <fieldset class="search-task__categories">
              <legend>Категории</legend>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="" checked disabled>
                <span>Курьерские услуги</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="" checked>
                <span>Грузоперевозки</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Переводы</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Строительство и ремонт</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Выгул животных</span>
              </label>
            </fieldset>
            <fieldset class="search-task__categories">
              <legend>Дополнительно</legend>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Сейчас свободен</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Сейчас онлайн</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>Есть отзывы</span>
              </label>
              <label class="checkbox__legend">
                <input class="visually-hidden checkbox__input" type="checkbox" name="" value="">
                <span>В избранном</span>
              </label>
            </fieldset>
            <label class="search-task__name" for="110">Поиск по имени</label>
            <input class="input-middle input" id="110" type="search" name="q" placeholder="">
            <button class="button" type="submit">Искать</button>
          </form>
        </div>

</section>
