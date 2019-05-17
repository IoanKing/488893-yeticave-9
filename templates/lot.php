<main>
    <nav class="nav">
      <ul class="nav__list container">
        <?php if ($cathegory && !empty($cathegory)): ?>
          <?php foreach ($cathegory as $value): ?>
            <li class="nav__item">
              <a href="/cathegory.php?id=<?=$value['id']?>"><?=esc($value['name'])?></a>
            </li>
          <?php endforeach; ?>
        <?php endif;?>
      </ul>
    </nav>
    <section class="lot-item container">
      <?php if (!empty($lot)): ?>
      <h2><?=esc($lot['title'])?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="/uploads/<?=$lot['picture']?>" width="730" height="548" alt="Сноуборд">
          </div>
          <p class="lot-item__category">Категория: <span><?=$lot['cathegory']?></span></p>
          <p class="lot-item__description">
              <?=$lot['description']?>
          </p>
        </div>
        <div class="lot-item__right">
          <div class="lot-item__state">
            <div class="lot-item__timer timer <?=get_class_finishing($lot['end_date']);?>">
              <?=get_timer_lelt($lot['end_date'])?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=amount_format(floatval($lot['price'])).' ₽'?></span>
              </div>
              <div class="lot-item__min-cost">
    Мин. ставка <span><?=amount_format(floatval($lot['staf_step'])).' ₽'?></span>
              </div>
            </div>
            <?php if (!empty($user_name) && !$is_user_add_staf): ?>
            <form class="lot-item__form" action="lot.php" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?=(isset($errors['staf'])) ? 'form__item--invalid' : ''?>">
                <input id="lot_id" type="hidden" name="lot_id" value="<?=$lot['id']?>"
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="cost" placeholder="<?=amount_format($min_rate)?>">
                <?php if (isset($errors['staf'])) : ?>
                    <span class="form__error"><?=$errors['staf']?></span>
                <?php endif; ?>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
            <?php endif; ?>
          </div>
          <div class="history">
            <?=$staf_history?>
          </div>
        </div>
      </div>
      <?php endif;?>
    </section>
</main>