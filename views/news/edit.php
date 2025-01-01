<?php
/** @var array $news */
/** @var array $errors */
/** @var array $model */

$this->Title = 'Редагувати новину';
?>

<div class="form-wrap">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="info">
            <h1 class="title">Редагування новини</h1>
        </div>

        <div class="form-part">
            <div>
                <label for="title">Заголовок</label>
            </div>
            <div>
                <?php if (!empty($errors['title'])): ?>
                    <input type="text" name="title" id="title" value="<?= htmlspecialchars($model['title']) ?>" placeholder="Title">
                <?php else: ?>
                    <input type="text" name="title" id="title" value="<?= htmlspecialchars($news['title']) ?>" placeholder="Title">
                <?php endif; ?>
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
                <?php if (!empty($errors['content'])): ?>
                    <input type="text" name="content" id="content" value="<?= htmlspecialchars($model['content']) ?>" placeholder="Content">
                <?php else: ?>
                    <input type="text" name="content" id="content" value="<?= htmlspecialchars($news['content']) ?>" placeholder="Content">
                <?php endif; ?>
            </div>
            <?php if (!empty($errors['content'])): ?>
                <div class="error">
                    <p><?= htmlspecialchars($errors['content']); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-part">
            <?php $filePath = 'files/news/' . $news['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="form-photo">
                    <img src="/<?= $filePath ?>" alt="Current photo">
                </div>
            <?php else: ?>
                <div class="form-photo">
                    <img src="/files/images/no-image.jpg" alt="No photo">
                </div>
            <?php endif; ?>
        </div>

        <div class="form-part">
            <div>
                <label for="file">Виберіть фото</label>
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
            <button class="button" type="submit">Зберегти</button>
            <a href="/news/view/<?=$model['id'] ?>" class="button-cancel"><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>

<script src="/static/js/file_input.js" defer></script>
