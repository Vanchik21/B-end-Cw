<?php
/** @var array $animals */


use models\Users;

$this->Title = 'Тварини';
?>

<div class="info center">
    <h1>Всі тварини у зоопарку</h1>
</div>
<div class="wrap">
    <?php foreach ($animals

                   as $animal) : ?>
        <div class="animal">
            <?php $filePath = 'files/animals/' . $animal['image']; ?>
            <?php if (is_file($filePath)) : ?>
                <div class="block-item">
                    <img src="/<?= $filePath ?>" alt="">
                </div>
            <?php else: ?>
                <div class="block-item">
                    <img src="/files/images/no-image.jpg" alt="">
                </div>
            <?php endif; ?>
            <div class="block-item">
                <h5><?= htmlspecialchars($animal['name']) ?></h5>
            </div>
            <div class="block-item">
                <div class="buttons-item">
                    <a href="/animal/view/<?= $animal['id'] ?>">
                        <div class="button">Докладніше</div>
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<div class="add-item">
    <?php if (Users::isAdmin()) : ?>
        <a href="/animal/add">
            <div class="button">Додати</div>
        </a>
    <?php endif; ?>
</div>

