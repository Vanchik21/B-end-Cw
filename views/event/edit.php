<?php
/** @var array $event */
/** @var array $errors */
/** @var array $model */

$this->Title = 'Редагування події';
?>
<div>
    <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <div class="title">
                <h1>Редагування події</h1>
            </div>
        </div>
        <div class="form-part">
            <div>
                <label for="title">Заголовок</label>
            </div>
            <div>
                <input type="text" name="title" id="title"
                       value="<?= htmlspecialchars($model['title'] ?? $event['title']) ?>">
            </div>
            <?php if (!empty($errors['title'])): ?>
                <div class="error">
                    <p><?= $errors['title']; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="description">Опис</label>
            </div>
            <div>
                <input type="text" name="description" id="description"
                       value="<?= htmlspecialchars($model['description'] ?? $event['description']) ?>">
            </div>
            <?php if (!empty($errors['description'])): ?>
                <div class="error">
                    <p><?= $errors['description']; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="event_date">Дата події</label>
            </div>
            <div>
                <input type="date" name="event_date" id="event_date"
                       value="<?= htmlspecialchars($model['event_date'] ?? $event['event_date']) ?>">
            </div>
            <?php if (!empty($errors['event_date'])): ?>
                <div class="error">
                    <p><?= $errors['event_date']; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="time">Час події</label>
            </div>
            <div>
                <input type="time" name="time" id="time"
                       value="<?= htmlspecialchars($model['time'] ?? $event['time']) ?>">
            </div>
            <?php if (!empty($errors['time'])): ?>
                <div class="error">
                    <p><?= $errors['time']; ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <?php $filePath = 'files/events/' . $event['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="form-photo">
                    <img src="/<?= $filePath ?>" alt="">
                </div>
            <?php else: ?>
                <div class="form-photo">
                    <img src="/files/images/no-image.jpg" alt="">
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="file">Choose a photo</label>
                <p class="chosen-files"></p>
            </div>
            <div>
                <input type="file" name="image" id="image" accept="image/jpeg">
            </div>
        </div>
        <div class="choice-buttons">
            <button class="button add" type="submit">Зберегти</button>
            <a href="/event/view/<?= $event['id'] ?>" class="button-cancel">
                <div class="button">Відмінити</div>
            </a>
        </div>
    </form>
</div>
<script src="/static/js/file_input.js"></script>
