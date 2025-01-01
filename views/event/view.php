<?php
/** @var array $eventsItem */

use models\Users;

$this->Title = 'Подія';
?>
<div class="wrap-comment">
    <div class="block event-view">
        <?php $filePath = 'files/events/' . $eventsItem['image']; ?>
        <?php if (is_file($filePath)) : ?>
            <div class="block-item-event">
                <img src="/<?= $filePath ?>" alt="Event Image">
            </div>
        <?php else: ?>
            <div class="block-item-event">
                <img src="/files/images/no-image.jpg" alt="No image available">
            </div>
        <?php endif; ?>
        <div>
            <p class="created-at">Дата події: <?= date('Y-m-d', strtotime($eventsItem['event_date'])) ?> о <?= date('H:i', strtotime($eventsItem['time'])) ?></p>
        </div>
        <div class="block-item-event">
            <h5><?= htmlspecialchars($eventsItem['title']) ?></h5>
        </div>
        <div class="block-item-event">
            <p class="description small"><?= htmlspecialchars($eventsItem['description']) ?></p>
        </div>
    </div>
    <div class="event-button">
        <?php if (Users::isAdmin()) : ?>
            <div class="block-item-event with-buttons">
                <a href="/event/edit/<?= $eventsItem['id'] ?>">
                    <div class="button with-border">Редагувати</div>
                </a>
            </div>

            <div class="block-item-event with-buttons">
                <a href="/event/delete/<?= $eventsItem['id'] ?>">
                    <div class="button with-border">Видалити</div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="back">
    <a href="/event">
        <div class="button">Повернутись</div>
    </a>
</div>

