<?php

/** @var array $animal */

$this->Title = 'Видалити тварину';
?>
<div class="form-wrap">
    <form action="" method="post">
        <div class="info">
            <h1>Видалити "<?= htmlspecialchars($animal['name']) ?>" ?</h1>
        </div>
        <div class="form-part">
            <div>
                <label for="name">Тварина</label>
            </div>
            <div>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($animal['name']) ?>"
                       readonly="readonly">
            </div>
        </div>
        <div class="form-part choice-buttons">
            <a href="/animal/delete/<?= $animal['id'] ?>/yes">
                <div class="button">Видалити</div>
            </a>
            <a href="/animal/view/<?=$animal['id'] ?>" class="button-cancel">
                <div class="button">Відмінити</div>
            </a>
        </div>
    </form>
</div>
