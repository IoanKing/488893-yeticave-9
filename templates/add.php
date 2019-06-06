<main>
    <nav class="nav">
        <?= $nav_list ?>
    </nav>
    <form class="form form--add-lot container <?= (!empty($errors))
      ? 'form--invalid' : '' ?>" action="add.php" method="post"
          enctype="multipart/form-data"> <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item <?= isset($errors['lot-name'])
              ? 'form__item--invalid' : '' ?>"> <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name"
                       placeholder="Введите наименование лота"
                       value="<?= isset($post['lot-name'])
                         ? esc($post['lot-name']) : '' ?>">
                <?php if (isset($errors['lot-name'])) : ?>
                    <span class="form__error"><?= $errors['lot-name'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form__item <?= isset($errors['category'])
              ? 'form__item--invalid' : '' ?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="category">
                    <option value="">Выберите категорию</option>
                    <?php if ($cathegory && !empty($cathegory)): ?>
                        <?php foreach ($cathegory as $value): ?>
                            <option value="<?= isset($value['id'])
                              ? esc($value['id'])
                              : '' ?>" <?= ($post['category']
                              === esc($value['id'])) ? 'selected'
                              : '' ?>><?= isset($value['name'])
                                  ? esc($value['name']) : '' ?></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <?php if (isset($errors['category'])) : ?>
                    <span class="form__error"><?= $errors['category'] ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form__item form__item--wide <?= isset($errors['message'])
          ? 'form__item--invalid' : '' ?>">
            <label for="message">Описание <sup>*</sup></label>
            <textarea id="message" name="message"
                      placeholder="Напишите описание лота"><?= isset($post['message'])
                  ? esc($post['message']) : '' ?></textarea>
            <?php if (isset($errors['message'])) : ?>
                <span class="form__error"><?= $errors['message'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--file <?= isset($errors['file'])
          ? 'form__item--invalid' : '' ?>">
            <label>Изображение <sup>*</sup></label>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="lot-img"
                       name="file"
                       value="<?= isset($post['file']) ? esc($post['file'])
                         : '' ?>">
                <label for="lot-img">
                    Добавить
                </label>
            </div>
            <?php if (isset($errors['file'])) : ?>
                <span class="form__error"><?= $errors['file'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small <?= isset($errors['lot-rate'])
              ? 'form__item--invalid' : '' ?>">
                <label for="lot-rate">Начальная цена <sup>*</sup></label>
                <input id="lot-rate" type="text" name="lot-rate" placeholder="0"
                       value="<?= isset($post['lot-rate'])
                         ? esc($post['lot-rate']) : '' ?>">
                <?php if (isset($errors['lot-rate'])) : ?>
                    <span class="form__error"><?= $errors['lot-rate'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form__item form__item--small  <?= isset($errors['lot-step'])
              ? 'form__item--invalid' : '' ?>">
                <label for="lot-step">Шаг ставки <sup>*</sup></label>
                <input id="lot-step" type="text" name="lot-step" placeholder="0"
                       value="<?= isset($post['lot-step'])
                         ? esc($post['lot-step']) : '' ?>">
                <?php if (isset($errors['lot-step'])) : ?>
                    <span class="form__error"><?= $errors['lot-step'] ?></span>
                <?php endif; ?>
            </div>
            <div class="form__item <?= isset($errors['lot-date'])
              ? 'form__item--invalid' : '' ?>">
                <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
                <input class="form__input-date" id="lot-date" type="text"
                       name="lot-date"
                       placeholder="Введите дату в формате ГГГГ-ММ-ДД"
                       value="<?= isset($post['lot-date'])
                         ? esc($post['lot-date']) : '' ?>">
                <?php if (isset($errors['lot-date'])) : ?>
                    <span class="form__error"><?= $errors['lot-date'] ?></span>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty($errors)) : ?>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <?php endif; ?>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>