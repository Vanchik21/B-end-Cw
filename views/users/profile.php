<?php
/** @var array $user */


$this->Title = 'Профіль';
?>
<div class="main_profile">
    <div class="portal">
        <h1>Профіль</h1>
    </div>
</div>
<div class="profile_block">
    <p>Дані користувача:<span><?= htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname']) ?></span></p>
    <p>Рівень доступу: <?= $user['access_level'] == 2 ? 'Адміністратор' : 'Користувач' ?></p>
</div>
<div class="action_button">
    <div class="profile-buttons">
        <a href="/users/edit/<?= $user['id'] ?>">
            <div class="button">Пароль</div>
        </a>
    </div>
    <div class="profile-buttons">
        <a href="/users/delete/<?= $user['id'] ?>">
            <div class="button">Видалити</div>
        </a>
    </div>
</div>