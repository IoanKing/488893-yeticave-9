<ul class="nav__list container">
    <?php if ($cathegory && !empty($cathegory)): ?>
        <?php foreach ($cathegory as $value): ?>
            <?php
            $current_class = '';
            if (isset($value['id']) && isset($cathegory_id)) {
                if ($value['id'] === $cathegory_id) {
                    $current_class = 'nav__item--current';
                }
            }
            ?>
            <li class="nav__item <?= $current_class ?>">
                <a href="/cathegory.php?id=<?= isset($value['id'])
                  ? esc($value['id']) : '' ?>"><?= isset($value['name'])
                      ? esc($value['name']) : '' ?></a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
