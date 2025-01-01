<?php
/** @var string $error_message */
$this->Title = 'Вхід';
?>

<div class="login_form">
    <form method="post" action="">
        <div class="input_flex">
            <label for="inputEmail">Пошта</label>
            <input name="login" type="email" id="inputEmail">
        </div>
        <div class="input_flex">
            <label for="inputPassword">Пароль</label>
            <input name="password" type="password" id="inputPassword">
        </div>
        <?php
        if (!empty($error_message)): ?>
            <div class="error">
                <?=$error_message ?>
            </div>
        <?php endif; ?>
        <button class="button">Увійти</button>
    </form>
</div>