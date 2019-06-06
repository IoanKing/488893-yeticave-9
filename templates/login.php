<main>
    <nav class="nav">
        <?= $nav_list ?>
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