<main>
    <nav class="nav">
        <?= $nav_list ?>
    </nav>
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php if ($user_rates && !empty($user_rates)): ?>
                <?php foreach ($user_rates as $value): ?>
                    <?php
                    $end_date = isset($value['end_date']) ? $value['end_date']
                      : '';
                    $winner_id = isset($value['winner_id'])
                      ? $value['winner_id'] : '';
                    ?>
                    <tr class="rates__item <?= get_bets_class(
                        $end_date,
                        $winner_id,
                        $user_id
                    ) ?>">
                        <td class="rates__info">
                            <div class="rates__img">
                                <img src="/uploads/<?= isset($value['picture'])
                                  ? $value['picture'] : '' ?>" width="54"
                                     height="40"
                                     alt="<?= esc($value['title']) ?>">
                            </div>
                            <div>
                                <h3 class="rates__title"><a
                                            href="lot.php?id=<?= $value['lot_id'] ?>"><?= esc($value['title']) ?></a>
                                </h3>
                                <?php if (!empty($value['winner_id'])
                                  && $value['winner_id'] === $user_id
                                ) : ?>
                                    <p><?= esc($value['contact']) ?></p>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td class="rates__category"><?= $value['cathegory'] ?></td>
                        <td class="rates__timer">
                            <div class="timer <?= get_timer_class(
                                    $value['end_date'],
                                    $value['winner_id'],
                                    $user_id
                            ) ?>"><?= get_timer_rate(
                                $value['end_date'],
                                $value['winner_id'],
                                $user_id
                                ) ?></div>
                        </td>
                        <td class="rates__price"><?= amount_format(floatval($value['rate']))
                            . ' ₽' ?></td>
                        <td class="rates__time"><?= get_timer_past($value['staf_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>

    </section>
</main>