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
    <section class="lot-item container">
        <h2>404 Страница не найдена</h2>
        <p>Данной страницы не существует на сайте.</p>
    </section>
</main>