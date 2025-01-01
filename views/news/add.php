<?php
/** @var array $errors */
/** @var array $model */

$this->Title = 'Додати новину';
?>

<div class="form-wrap">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <h1 class="title">Додати новину</h1>
        </div>

        <div class="form-part">
            <div>
                <label for="title">Заголовок</label>
            </div>
            <div>
                <input type="text" name="title" id="title" value="<?= htmlspecialchars($model['title']) ?>" placeholder="Заголовок">
            </div>
            <?php if (!empty($errors['title'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['title']); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-part">
            <div>
                <label for="content">Вміст</label>
            </div>
            <div>
                <input type="text" name="content" id="content" value="<?= htmlspecialchars($model['content']) ?>" placeholder="Вміст">
            </div>
            <?php if (!empty($errors['content'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['content']); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-part">
            <div>
                <label for="file">Вибрати фото</label>
                <p class="chosen-files"></p>
            </div>
            <div>
                <input type="file" name="image" id="image" accept="image/jpeg">
            </div>
            <?php if (!empty($errors['image'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['image']); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-part choice-buttons">
            <button class="button add" type="submit">Додати</button>
            <a href="/news" ><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>

<script src="/static/js/file_input.js" defer></script>
