<?php
/** @var array $news */

$this->Title = 'Видалити новину';
?>
<div class="form-wrap">
    <form action="" method="post">
        <div class="info">
            <h1>Delete "<?=$news['title'] ?>"?</h1>
        </div>
        <div class="form-part">
            <div>
                <label for="title">Title</label>
            </div>
            <div>
                <input type="text" name="title" id="title" value="<?= $news['title'] ?>" readonly="readonly">
            </div>
        </div>
        <div class="form-part choice-buttons">
            <a href="/news/delete/<?=$news['id'] ?>/yes"><div class="button">Видалити</div></a>
            <a href="/news"><div class="button">Відмінити</div></a>
        </div>
    </form>
</div>

