<?php
$this->Title = 'Головна сторінка'
/** @var array $events */
/** @var array $news */
?>
<div>
    <h1>Вітає Каракум</h1>
</div>
<br>
<h2>Наші новини</h2>
<br>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($news as $new) : ?>
            <div class="swiper-slide">
                <div class="item-slider green">
                    <img class="slider-image" src="/files/news/<?= htmlspecialchars($new['image']) ?>">
                    <h3><?= htmlspecialchars($new['title']) ?></h3>
                    <p><?= htmlspecialchars($new['created_at']) ?></p>
                    <div class="slider-actions">
                        <a href="/news/view/<?= $new['id'] ?>">
                            <div class="button">Докладніше</div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<h2>Наші події</h2>
<br>
<div class="swiper-container">
    <div class="swiper-wrapper">
        <?php foreach ($events as $event) : ?>
            <div class="swiper-slide">
                <div class="item-slider orange">
                    <img class="slider-image" src="/files/events/<?= htmlspecialchars($event['image']) ?>">
                    <h3><?= htmlspecialchars($event['title']) ?></h3>
                    <p><?= htmlspecialchars($event['event_date']) ?></p>
                    <p><?= htmlspecialchars($event['time']) ?></p>
                    <div class="slider-actions">
                        <a href="/event/view/<?= $event['id'] ?>">
                            <div class="button">Докладніше</div>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
<script src="/static/js/slider.js"></script>
