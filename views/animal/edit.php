<?php
/** @var array $errors */
/** @var array $model */
/** @var array $animal */

$this->Title = 'Редагувати тварину';
?>
<div>
    <form class="form-wrap" action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <div class="title">
                <h1>Редагування тварини</h1>
            </div>
        </div>
        <div class="form-part">
            <div>
                <label for="name">Тварина</label>
            </div>
            <div>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($model['name'] ?? $animal['name']) ?>">
            </div>
            <?php if (!empty($errors['name'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['name']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="species">Вид</label>
            </div>
            <div>
                <input type="text" name="species" id="species" value="<?= htmlspecialchars($model['species'] ?? $animal['species']) ?>">
            </div>
            <?php if (!empty($errors['species'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['species']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="description">Опис</label>
            </div>
            <div>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($model['description'] ?? $animal['description']) ?>">
            </div>
            <?php if (!empty($errors['description'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['description']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <?php $filePath = 'files/animals/' . $animal['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="form-photo">
                    <img src="/<?= $filePath ?>" alt="Animal Image">
                </div>
            <?php else: ?>
                <div class="form-photo">
                    <img src="/files/images/no-image.jpg" alt="No image">
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="file">Вибрати нове фото</label>
                <p class="chosen-files"></p>
            </div>
            <div>
                <input type="file" name="file" id="file" accept="image/jpeg">
            </div>
        </div>
        <div class="choice-buttons">
            <button class="button add" type="submit">Зберегти</button>
            <a href="/animal/view/<?=$animal['id'] ?>" class="button-cancel">
                <div class="button">Відмінити</div>
            </a>
        </div>
    </form>
</div>
<script src="/static/js/file_input.js"></script>