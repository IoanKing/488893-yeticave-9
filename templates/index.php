<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <!--заполните этот список из массива категорий-->
          <?php if ($cathegory && !empty($cathegory)): ?>
            <?php foreach ($cathegory as $value): ?>
            <li class="promo__item promo__item--<?=esc($value['code'])?>">
                <a class="promo__link" href="pages/all-lots.html"><?=esc($value['name'])?></a>
            </li>
            <?php endforeach; ?>
          <?php endif;?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
        <?php if ($adverts && !empty($adverts)): ?>
        <?php foreach ($adverts as $value): ?>
            <li class="lots__item lot">
                <div class="lot__image">
                    <img src="/uploads/<?=esc($value['picture'])?>" width="350" height="260" alt="">
                </div>
                <div class="lot__info">
                    <span class="lot__category"><?=esc($value['cathegory'])?></span>
                    <h3 class="lot__title"><a class="text-link" href="lot.php?id=<?=esc($value['id'])?>"><?=esc($value['title'])?></a></h3>
                    <div class="lot__state">
                        <div class="lot__rate">
                            <span class="lot__amount">Стартовая цена</span>
                            <span class="lot__cost"><?=amount_format(floatval($value['start_price'])).' ₽'?></span>
                        </div>
                        <div class="lot__timer timer <?=get_class_finishing($value['end_date']);?>">
                            <?=get_timer_format($value['end_date'])?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
        <?php endif;?>
        </ul>
    </section>
</main>
