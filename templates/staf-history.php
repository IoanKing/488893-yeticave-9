<h3>История ставок (<span><?= count($rates); ?></span>)</h3>
<table class="history__list">
    <?php if ($rates && !empty($rates)): ?>
        <?php foreach ($rates as $value): ?>
            <tr class="history__item">
                <td class="history__name"><?= isset($value['name'])
                      ? esc($value['name']) : '' ?></td>
                <td class="history__price"><?= isset($value['amount'])
                      ? amount_format(floatval($value['amount'])) . ' ₽'
                      : '' ?></td>
                <td class="history__time"><?= isset($value['staf_date'])
                      ? get_timer_past($value['staf_date']) : '' ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
