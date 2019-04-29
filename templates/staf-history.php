<h3>История ставок (<span><?=count($rates);?></span>)</h3>
<table class="history__list">
  <?php if ($rates && $rates !== ""): ?>
    <?php foreach ($rates as $value): ?>
      <tr class="history__item">
        <td class="history__name"><?=$value['name']?></td>
        <td class="history__price"><?=amount_format(floatval($value['amount'])).' ₽'?></td>
        <td class="history__time">5 минут назад</td>
      </tr>
    <?php endforeach; ?>
  <?php endif;?>
</table>
