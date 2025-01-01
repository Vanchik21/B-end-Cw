<?php
/** @var string $error_message */
$this->Title = 'Реєстрація';
?>

<div class="login_form">
    <form method="post" action="">
        <div class="input_flex">
            <label for="inputEmail">Пошта</label>
            <input value="<?=$this->controller->post->login?>" name="login" type="email" id="inputEmail">
        </div>
        <div class="input_flex">
            <label for="inputPassword">Пароль</label>
            <input name="password" type="password" id="inputPassword">
        </div>
        <div class="input_flex">
            <label for="inputPassword2">Повторіть пароль</label>
            <input name="password2" type="password" id="inputPassword2">
        </div>
        <div class="input_flex">
            <label for="inputFirstname">Ім'я</label>
            <input value="<?=$this->controller->post->firstname?>" name="firstname" type="text" id="inputFirstname">
        </div>
        <div class="input_flex">
            <label for="inputLastname">Прізвище</label>
            <input value="<?=$this->controller->post->lastname?>" name="lastname" type="text" id="inputLastname">
        </div>
        <?php
        if (!empty($error_message)): ?>
            <div class="error">
                <?=$error_message ?>
            </div>
        <?php endif; ?>
        <button class="button">Реєструвати</button>
    </form>
</div>