<main>
    <nav class="nav">
        <ul class="nav__list container">
            <?php if ($cathegory && !empty($cathegory)): ?>
                <?php foreach ($cathegory as $value): ?>
                    <li class="nav__item">
                        <a href="/cathegory.php?id=<?= isset($value['id'])
                          ? esc($value['id']) : '' ?>"><?= isset($value['name'])
                              ? esc($value['name']) : '' ?></a>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <section class="lots">
            <h2><?= (count($pagination) !== 0)
                  ? 'Результаты поиска по запросу «<span>' . $search_phrase
                  . '</span>»' : 'Ничего не найдено по вашему запросу' ?></h2>
            <ul class="lots__list">
                <?php if ($adverts && !empty($adverts)): ?>
                    <?php foreach ($adverts as $value): ?>
                        <li class="lots__item lot">
                            <div class="lot__image">
                                <img src="/uploads/<?= isset($value['picture'])
                                  ? $value['picture'] : '' ?>" width="350"
                                     height="260" alt="">
                            </div>
                            <div class="lot__info">
                                <span class="lot__category"><?= isset($value['cathegory'])
                                      ? esc($value['cathegory']) : '' ?></span>
                                <h3 class="lot__title"><a class="text-link"
                                                          href="lot.php?id=<?= isset($value['id'])
                                                            ? esc($value['id'])
                                                            : '' ?>"><?= isset($value['title'])
                                          ? esc($value['title']) : '' ?></a>
                                </h3>
                                <div class="lot__state">
                                    <div class="lot__rate">
                                        <span class="lot__amount">Стартовая цена</span>
                                        <span class="lot__cost"><?= isset($value['start_price'])
                                              ? amount_format(floatval($value['start_price']))
                                              . ' ₽' : '' ?></span>
                                    </div>
                                    <div class="lot__timer timer <?= isset($value['end_date'])
                                      ? get_class_finishing($value['end_date'])
                                      : '' ?>">
                                        <?= isset($value['end_date'])
                                          ? get_timer_lelt($value['end_date'])
                                          : '' ?>
                                    </div>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>
        </section>
        <?php if (count($pagination) > 1) : ?>
            <ul class="pagination-list">
                <li class="pagination-item pagination-item-prev"><a
                            href="<?= ($page > 1) ? '/search.php?search='
                              . $search_phrase . '&page=' . ($page - 1)
                              : '' ?>">Назад</a></li>
                <?php if ($pagination && !empty($pagination)): ?>
                    <?php foreach ($pagination as $value): ?>
                        <li class="pagination-item <?= ($page === $value)
                          ? 'pagination-item-active' : '' ?>"><a
                                    href="<?= ($page !== $value)
                                      ? '/search.php?search=' . $search_phrase
                                      . '&page=' . $value
                                      : '' ?>"><?= $value ?></a></li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="pagination-item pagination-item-next"><a
                            href="<?= (($page) < count($pagination))
                              ? '/search.php?search=' . $search_phrase
                              . '&page=' . ($page + 1) : '' ?>">Вперед</a></li>
            </ul>
        <?php endif; ?>
    </div>
</main>