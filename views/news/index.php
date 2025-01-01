<?php
/** @var array $rows */

use models\Users;

$this->Title = 'Новини';
?>

<div class="info center">
    <h1>Всі новини</h1>
</div>

<?php if (Users::isUserLogged()) : ?>
    <div class="sort">
        <div class="sort-wrap">
            <select name="select" id="select" data-module="news">
                <option value="created_at">Дата</option>
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
        <div class="block news">
            <?php $filePath = 'files/news/' . $row['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="block-item-news">
                    <img src="/<?= $filePath ?>" alt="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>">
                </div>
            <?php else: ?>
                <div class="block-item-news">
                    <img src="/files/images/no-image.jpg" alt="No image available">
                </div>
            <?php endif; ?>
            <div>
                <p class="created-at">Додано: <?= date('Y-m-d H:i:s', strtotime($row['created_at'])) ?></p>
            </div>
            <div class="block-item-news">
                <h5><?= htmlspecialchars($row['title'], ENT_QUOTES) ?></h5>
            </div>

            <div class="news-items">
                <div class="block-item-news with-buttons">
                    <a href="/news/view/<?= $row['id'] ?>">
                        <div class="button">Докладніше</div>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="add-item">
    <?php if (Users::isAdmin()) : ?>
        <a href="/news/add">
            <div class="button">Додати</div>
        </a>
    <?php endif; ?>
</div>
