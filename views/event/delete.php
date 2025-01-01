<?php
/** @var array $event */

$this->Title = 'Видалити подію';
?>
<div class="form-wrap">
    <form action="" method="post">
        <div class="info">
            <h1>Видалити "<?= $event['title'] ?>"?</h1>
        </div>
        <div class="form-part">
            <div>
                <label for="title">Заголовок</label>
            </div>
            <div>
                <input type="text" name="title" id="title" value="<?= $event['title'] ?>" readonly="readonly">
            </div>
        </div>
        <div class="form-part choice-buttons">
            <a href="/event/delete/<?= $event['id'] ?>/yes">
                <div class="button">Видалити</div>
            </a>
            <a href="/event/view/<?= $event['id'] ?>" class="button-cancel">
                <div class="button">Відмінити</div>
            </a>
        </div>
    </form>
</div>