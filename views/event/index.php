<?php
/** @var array $rows */

use models\Users;

$this->Title = 'Події';
?>

<div class="info center">
    <h1>Всі події</h1>
</div>
<?php if (Users::isUserLogged()): ?>
    <div class="sort">
        <div class="sort-wrap">
            <select name="select" id="select" data-module="event">
                <option value="event_date">Дата</option>
                <option value="default" selected>Повернути</option>
            </select>
            <a href="" id="sort-link">
                <div class="button">Сортувати</div>
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="info center">
        <p>Увійдіть, щоб просортувати</p>
    </div>
<?php endif; ?>
<div class="wrap">
    <?php foreach ($rows as $row) : ?>
        <div class="event">
            <?php $filePath = 'files/events/' . $row['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="block-item-event">
                    <img src="/<?= $filePath ?>" alt="Event Image">
                </div>
            <?php else: ?>
                <div class="block-item-event">
                    <img src="/files/images/no-image.jpg" alt="No Image">
                </div>
            <?php endif; ?>
            <div class="block-item-event">
                <p class="date small"><?= htmlspecialchars($row['event_date'], ENT_QUOTES, 'UTF-8') ?></p>
                <p class="time small"><?= htmlspecialchars($row['time'], ENT_QUOTES, 'UTF-8') ?></p>
            </div>
            <div class="block-item-event">
                <h5><?= htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') ?></h5>
            </div>
            <div class="buttons-item">
                    <div class="block-item with-buttons padding">
                        <a href="/event/view/<?= $row['id'] ?>">
                            <div class="button with-border">Докладніше</div>
                        </a>
                    </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="add-item">
    <?php if (Users::isAdmin()) : ?>
        <a href="/event/add">
            <div class="button">Додати</div>
        </a>
    <?php endif; ?>
</div>
