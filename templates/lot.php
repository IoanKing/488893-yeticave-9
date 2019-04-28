<main>
    <nav class="nav">
      <ul class="nav__list container">
        <?php if ($cathegory && !empty($cathegory)): ?>
          <?php foreach ($cathegory as $value): ?>
            <li class="nav__item">
              <a href="pages/all-lots.html"><?=esc($value['name'])?></a>
            </li>
          <?php endforeach; ?>
        <?php endif;?>
      </ul>
    </nav>
    <section class="lot-item container">
      <?php if (!empty($lots)): ?>
      <h2><?=esc($lots['title'])?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="../img/<?=$lots['picture']?>" width="730" height="548" alt="Сноуборд">
          </div>
          <p class="lot-item__category">Категория: <span><?=$lots['cathegory']?></span></p>
          <p class="lot-item__description">
              <?=$lots['description']?>
          </p>
        </div>
        <div class="lot-item__right">
          <div class="lot-item__state">
            <div class="lot-item__timer timer <?=get_class_finishing($lots['end_date']);?>">
              <?=get_timer_format($lots['end_date'])?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=amount_format(floatval($lots['price'])).' ₽'?></span>
              </div>
              <div class="lot-item__min-cost">
    Мин. ставка <span><?=amount_format(floatval($lots['staf_step'])).' ₽'?></span>
              </div>
            </div>
            <form class="lot-item__form" action="https://echo.htmlacademy.ru" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item form__item--invalid">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?=amount_format(floatval($lots['staf_step']))?>">
                <span class="form__error">Введите наименование лота</span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <div class="history">
            <?=$staf_history?>
          </div>
        </div>
      </div>
      <?php endif;?>
    </section>
</main>