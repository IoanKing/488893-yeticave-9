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
      <h2>403 Доступ запрещен</h2>
      <p>Вы не авторизованы на сайте.</p>
    </section>
</main>
