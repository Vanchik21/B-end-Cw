<?php
/** @var array $newsItem */

/** @var array $comments */

use models\Users;

$this->Title = 'Новина';
?>
<div class="wrap-comment">
    <div class="block news-view">
        <?php $filePath = 'files/news/' . $newsItem['image']; ?>
        <?php if (is_file($filePath)) : ?>
            <div class="block-item-news">
                <img src="/<?= $filePath ?>" alt="News Image">
            </div>
        <?php else: ?>
            <div class="block-item-news">
                <img src="/files/images/no-image.jpg" alt="No image available">
            </div>
        <?php endif; ?>
        <div>
            <p class="created-at">Додано: <?= date('Y-m-d H:i:s', strtotime($newsItem['created_at'])) ?></p>
        </div>
        <div class="block-item-news">
            <h5><?= htmlspecialchars($newsItem['title']) ?></h5>
        </div>
        <div class="block-item-news">
            <p class="description small"><?= htmlspecialchars($newsItem['content']) ?></p>
        </div>
    </div>
    <div class="news-button">
        <?php if (Users::isAdmin()) : ?>
            <div class="block-item-news with-buttons">
                <a href="/news/edit/<?= $newsItem['id'] ?>">
                    <div class="button with-border">Редагувати</div>
                </a>
            </div>

            <div class="block-item-news with-buttons">
                <a href="/news/delete/<?= $newsItem['id'] ?>">
                    <div class="button with-border">Видалити</div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

<h2 class="comment">Відгуки</h2>

<?php if (Users::isUserLogged()): ?>
    <div class="comment-form">
        <form action="/news/addComment" method="post">
            <input type="hidden" name="news_id" value="<?= htmlspecialchars($newsItem['id']) ?>">
            <div class="form-group">
                <label for="content">Додати відгук:</label>
                <input name="content" id="content" class="input-comment" placeholder="Ваш відгук" required>
            </div>
            <button class="button" type="submit">Відправити</button>
        </form>
    </div>
<?php else: ?>
    <p class="log">Ви повині увійти, щоб написати.</p>
<?php endif; ?>

<div class="comments">
    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="comment-item">
                <div class="text-comment">
                    <p>Відправив: <?= htmlspecialchars($comment['username']) ?> о
                        <span><?= date('Y-m-d', strtotime($comment['created_at'])) ?></span></p>
                    <p><?= htmlspecialchars($comment['content']) ?></p>
                </div>
                <?php if (Users::isUserLogged() && (Users::getLoggedUserId() == $comment['user_id'] || Users::isAdmin())): ?>
                    <form action="/news/deleteComment/<?= $comment['id'] ?>" method="post">
                        <button class="button delete" data-comment-id="<?= $comment['id'] ?>">Видалити</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <?php if (Users::isUserLogged()): ?>
            <p class="no-com">Жодного відгуку, ваш буде першим!</p>
        <?php endif; ?>
    <?php endif; ?>
</div>

<div class="back">
    <a href="/news">
        <div class="button">Повернутись</div>
    </a>
</div>
