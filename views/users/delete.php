<?php
/** @var array $user */
$this->Title = 'Видалити користувача';
?>

<div class="form-wrap">
    <form action="" method="post">
        <div class="info">
            <h2>Видалити <?=$user['login'] ?>?</h2>
        </div>
        <div class="form-part choice-buttons">
            <a href="/users/delete/<?=$user['id'] ?>/yes"><div class="button">Видалити</div></a>
            <a href="/users/profile" class="button-cancel"><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>