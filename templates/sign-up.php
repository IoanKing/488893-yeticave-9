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
    <form class="form container <?= (!empty($error)) ? 'form--invalid' : '' ?>"
          action="sign-up.php" method="post" autocomplete="off">
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?= isset($error['email'])
          ? 'form__item--invalid' : '' ?>">
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email"
                   placeholder="Введите e-mail"
                   value="<?= isset($post['email']) ? esc($post['email'])
                     : '' ?>">
            <?php if (isset($error['email'])) : ?>
                <span class="form__error"><?= $error['email'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= isset($error['password'])
          ? 'form__item--invalid' : '' ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password"
                   placeholder="Введите пароль"
                   value="<?= isset($post['password']) ? esc($post['password'])
                     : '' ?>">
            <?php if (isset($error['password'])) : ?>
                <span class="form__error"><?= $error['password'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= isset($error['name']) ? 'form__item--invalid'
          : '' ?>">
            <label for="name">Имя <sup>*</sup></label>
            <input id="name" type="text" name="name" placeholder="Введите имя"
                   value="<?= isset($post['name']) ? esc($post['name'])
                     : '' ?>">
            <?php if (isset($error['name'])) : ?>
                <span class="form__error"><?= $error['name'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= isset($error['message'])
          ? 'form__item--invalid' : '' ?>">
            <label for="message">Контактные данные <sup>*</sup></label>
            <textarea id="message" name="message"
                      placeholder="Напишите как с вами связаться"><?= isset($post['message'])
                  ? esc($post['message']) : '' ?></textarea>
            <?php if (isset($error['message'])) : ?>
                <span class="form__error"><?= $error['message'] ?></span>
            <?php endif; ?>
        </div>
        <?php if (!empty($error)) : ?>
            <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <?php endif; ?>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="/login.php">Уже есть аккаунт</a>
    </form>
</main>
