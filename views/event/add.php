<?php
/** @var array $errors */
/** @var array $model */

$this->Title = 'Додати подію';
?>
<div>
    <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <div class="title">
                <h1>Додавання події</h1>
            </div>
        </div>
        <div class="form-part">
            <div>
                <label for="title">Назва</label>
            </div>
            <div>
                <input type="text" name="title" id="title"
                       value="<?= isset($model['title']) ? htmlspecialchars($model['title']) : '' ?>"
                       placeholder="Назва">
            </div>
            <?php if (!empty($errors['title'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['title']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="description">Опис</label>
            </div>
            <div>
                <input name="description" id="description" placeholder="Опис"><?= isset($model['description']) ? htmlspecialchars($model['description']) : '' ?></input>
            </div>
            <?php if (!empty($errors['description'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['description']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="event_date">Дата події</label>
            </div>
            <div>
                <input type="date" name="event_date" id="event_date"
                       value="<?= isset($model['event_date']) ? htmlspecialchars($model['event_date']) : '' ?>">
            </div>
            <?php if (!empty($errors['event_date'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['event_date']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="time">Час події</label>
            </div>
            <div>
                <input type="time" name="time" id="time"
                       value="<?= isset($model['time']) ? htmlspecialchars($model['time']) : '' ?>">
            </div>
            <?php if (!empty($errors['time'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['time']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="file">Обрати фото</label>
                <p class="chosen-files"></p>
            </div>
            <div>
                <input type="file" name="image" id="image">
            </div>
            <?php if (!empty($errors['image'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['image']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part choice-buttons">
            <button class="button add" type="submit">Додати</button>
            <a href="/event" class="button-cancel">
                <div class="button">Відмінити</div>
            </a>
        </div>
    </form>
</div>
<script src="/static/js/file_input.js" defer></script>
