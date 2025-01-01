<?php

$this->Title = 'Зміна паролю';
?>
<div class="form-wrap">
    <form action="/users/edit" method="post">
        <div class="info">
            <h1 class="title">Зміна паролю</h1>
            <?php if (!empty($error_message)): ?>
                <div class="error">
                    <?= $error_message ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="input_flex">
            <div>
                <label for="new-password">Новий пароль</label>
            </div>
            <div>
                <input type="password" name="new-password" id="new-password" required>
            </div>
        </div>
        <div class="form-part choice-buttons">
            <button class="button" type="submit">Відмінити</button>
            <a href="/users/profile" class="button-cancel"><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>
