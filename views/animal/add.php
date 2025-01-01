<?php
/** @var array $errors */
/** @var array $model */

$this->Title = 'Додати тварину';
?>
<div class="form-wrap">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <h1 class="title">Додати тварину</h1>
        </div>
        <div class="form-part">
            <div>
                <label for="name">Назва тварини</label>
            </div>
            <div>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($model['name']) ?>" placeholder="Назва тварини">
            </div>
            <?php if (!empty($errors['name'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['name']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="species">Вид тварини</label>
            </div>
            <div>
                <input type="text" name="species" id="species" value="<?= htmlspecialchars($model['species']) ?>" placeholder="Вид тварини">
            </div>
            <?php if (!empty($errors['species'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['species']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="description">Опис тварини</label>
            </div>
            <div>
                <input type="text" name="description" id="description" value="<?= htmlspecialchars($model['description']) ?>" placeholder="Опис тварини">
            </div>
            <?php if (!empty($errors['description'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['description']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part">
            <div>
                <label for="file">Вибрати фото</label>
                <p class="chosen-files"></p>
            </div>
            <div>
                <input type="file" name="file" id="file">
            </div>
            <?php if (!empty($errors['file'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['file']); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="form-part choice-buttons">
            <button class="button add" type="submit">Додати</button>
            <a href="/animal" ><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>
<script src="/static/js/file_input.js" defer></script>
