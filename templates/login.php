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
          action="login.php" method="post">
        <h2>Вход</h2>
        <div class="form__item <?= (isset($error['email'])
          || isset($error['sign_up'])) ? 'form__item--invalid' : '' ?>">
            <label for="email">E-mail <sup>*</sup></label>
            <input id="email" type="text" name="email"
                   placeholder="Введите e-mail"
                   value="<?= isset($post['email']) ? esc($post['email'])
                     : '' ?>">
            <?php if (isset($error['email'])) : ?>
                <span class="form__error"><?= $error['email'] ?></span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--last <?= (isset($error['password'])
          || isset($error['sign_up'])) ? 'form__item--invalid' : '' ?>">
            <label for="password">Пароль <sup>*</sup></label>
            <input id="password" type="password" name="password"
                   placeholder="Введите пароль"
                   value="<?= isset($post['password']) ? esc($post['password'])
                     : '' ?>">
            <?php if (isset($error['password'])) : ?>
                <span class="form__error"><?= $error['password'] ?></span>
            <?php endif; ?>
        </div>
        <?php if (!empty($error)) : ?>
            <span class="form__error form__error--bottom"><?= isset($error['sign_up'])
                  ? esc($error['sign_up']) : '' ?></span>
        <?php endif; ?>
        <button type="submit" class="button">Войти</button>
    </form>
</main>