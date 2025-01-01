<?php
/** @var array $animals */

use models\Users;

$this->Title = 'Тварина';
?>
<?php if (!empty($animals)) : ?>
    <div class="info center">
        <h1>Тварина</h1>
    </div>
    <div class="wrap">
        <?php foreach ($animals as $animal) : ?>
            <div class="block animal-view">
                <?php $filePath = 'files/animals/' . $animal['image']; ?>
                <?php if (is_file($filePath)) : ?>
                    <div class="block-item-animal">
                        <img src="/<?= $filePath ?>" alt="">
                    </div>
                <?php else: ?>
                    <div class="block-item-animals">
                        <img src="/files/images/no-image.jpg" alt="">
                    </div>
                <?php endif; ?>
                <div class="block-item-animal">
                    <h5><?= htmlspecialchars($animal['name']) ?></h5>
                </div>
                <div class="block-item-animal">
                    <p class="species"><?= htmlspecialchars($animal['species']) ?></p>
                </div>
                <div class="block-item-animal description-text">
                    <p class="description"><?= htmlspecialchars($animal['description']) ?></p>
                </div>
                <div class="block-item-animal with-buttons">
                    <?php if (Users::isAdmin()) : ?>
                        <div class="block-item-animal">
                            <a href="/animal/edit/<?= $animal['id'] ?>">
                                <div class="button with-border">Редагувати</div>
                            </a>
                        </div>
                        <div class="block-item-animal">
                            <a href="/animal/delete/<?= $animal['id'] ?>">
                                <div class="button with-border">Видалити</div>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="form-part choice-buttons">
                    <a href="/animal" class="button-cancel">
                        <div class="button">Повернутись</div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="info center">
        <h1>Нема тварин</h1>
    </div>
<?php endif; ?>
<script src="/static/js/sort.js"></script>
