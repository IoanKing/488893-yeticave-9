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
  <form class="form form--add-lot container <?=(in_array(true, $error)) ? 'form--invalid' : ''?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
    <h2>Добавление лота</h2>
    <div class="form__container-two">
      <div class="form__item <?=($error['lot-name']) ? 'form__item--invalid' : ''?>"> <!-- form__item--invalid -->
        <label for="lot-name">Наименование <sup>*</sup></label>
        <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$post['lot-name']?>">
        <?php if ($error['lot-name']) : ?>
          <span class="form__error">Введите наименование лота</span>
        <?php endif; ?>
      </div>
      <div class="form__item <?=($error['category']) ? 'form__item--invalid' : ''?>">
        <label for="category">Категория <sup>*</sup></label>
        <select id="category" name="category">
          <option value="">Выберите категорию</option>
          <?php if ($cathegory && !empty($cathegory)): ?>
            <?php foreach ($cathegory as $value): ?>
              <option value="<?=esc($value['id'])?>" <?=($post['category']===esc($value['id'])) ? 'selected' : ''?>><?=esc($value['name'])?></option>
            <?php endforeach; ?>
          <?php endif;?>
        </select>
        <?php if ($error['category']) : ?>
          <span class="form__error">Выберите категорию</span>
        <?php endif; ?>
      </div>
    </div>
    <div class="form__item form__item--wide <?=($error['message']) ? 'form__item--invalid' : ''?>">
      <label for="message">Описание <sup>*</sup></label>
      <textarea id="message" name="message" placeholder="Напишите описание лота"><?=$post['message']?></textarea>
      <?php if ($error['message']) : ?>
      <span class="form__error">Напишите описание лота</span>
      <?php endif; ?>
    </div>
    <div class="form__item form__item--file <?=($error['file']) ? 'form__item--invalid' : ''?>">
      <label>Изображение <sup>*</sup></label>
      <div class="form__input-file">
        <input class="visually-hidden" type="file" id="lot-img" name="file" value="<?=$post['file']?>">
        <label for="lot-img">
          Добавить
        </label>
      </div>
      <?php if ($error['file']) : ?>
        <span class="form__error">Загрузите изображение в формате: jpg, jpeg, png.</span>
      <?php endif; ?>
    </div>
    <div class="form__container-three">
      <div class="form__item form__item--small <?=($error['lot-rate']) ? 'form__item--invalid' : ''?>">
        <label for="lot-rate">Начальная цена <sup>*</sup></label>
        <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=$post['lot-rate']?>">
        <?php if ($error['lot-rate']) : ?>
        <span class="form__error">Введите начальную цену</span>
        <?php endif; ?>
      </div>
      <div class="form__item form__item--small  <?=($error['lot-step']) ? 'form__item--invalid' : ''?>">
        <label for="lot-step">Шаг ставки <sup>*</sup></label>
        <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=$post['lot-step']?>">
        <?php if ($error['lot-step']) : ?>
        <span class="form__error">Введите шаг ставки</span>
        <?php endif; ?>
      </div>
      <div class="form__item <?=($error['lot-date']) ? 'form__item--invalid' : ''?>">
        <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
        <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД"  value="<?=$post['lot-date']?>">
        <?php if ($error['lot-date']) : ?>
        <span class="form__error">Введите дату завершения торгов</span>
        <?php endif; ?>
      </div>
    </div>
    <?php if (in_array(true, $error)) : ?>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
    <?php endif; ?>
    <button type="submit" class="button">Добавить лот</button>
  </form>
</main>