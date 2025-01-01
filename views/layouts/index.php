<?php
/** @var string $Title */

/** @var string $Content */

use models\Users;

if (empty($Title))
    $Title = '';
if (empty($Content))
    $Content = '';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $Title ?></title>
    <link rel="stylesheet" href="/static/css/style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@1.3.3/dist/css/splide-core.min.css">
</head>
<body>
<div class="wrapper">
    <header class="header">
        <div class="header_container ">
            <a href="/" class="header_logo">
                Каракум
            </a>
        </div>
        <div class="hamburger-menu">
            <div class="menu__btn" id="menuBtn">
                <span></span>
            </div>
            <ul class="menu__box" id="menuBox">
                <?php if (Users::isUserLogged()): ?>
                    <li><a class="menu__item" href="/users/profile">Профіль</a></li>
                <?php endif; ?>
                <li><a class="menu__item" href="/animal">Тварини</a></li>
                <li><a class="menu__item" href="/news">Новини</a></li>
                <li><a class="menu__item" href="/event">Події</a></li>
                <?php if (!Users::isUserLogged()): ?>
                <div class="down">
                    <li><a class="menu__item" href="/users/login">Увійти</a></li>
                    <li><a class="menu__item" href="/users/register">Зареєструватись</a></li>
                </div>
                <?php endif; ?>
                <?php if (Users::isUserLogged()): ?>
                    <li>
                        <a class="menu__item down" href="/users/logout">
                            Вихід
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </header>
    <main class="page">
        <div class="main-block">
            <div class="main-block_container _container">
                <div class="main-block_body">
                    <?= $Content ?>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer">
        <div class="footer_container _container">
            <div class="footer_body">
                <div class="footer_column">
                    <div class="footer_input">
                        <p class="white">Каракум</p>
                        <span class="white">©Житомирський зоопарк 2024. Усі права захищені</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
<script src="/static/js/script.js"></script>
