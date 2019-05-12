<h3>История ставок (<span><?=count($rates);?></span>)</h3>
<table class="history__list">
  <?php if ($rates && !empty($rates)): ?>
    <?php foreach ($rates as $value): ?>
      <tr class="history__item">
        <td class="history__name"><?=$value['name']?></td>
        <td class="history__price"><?=amount_format(floatval($value['amount'])).' ₽'?></td>
        <td class="history__time"><?=get_timer_past($value['staf_date']);?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif;?>
</table>
