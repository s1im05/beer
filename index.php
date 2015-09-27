<?php
header('Content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Brauwelt Brewery - крафтовое пиво в Челябинске</title>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/common.css" rel="stylesheet" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    
    <link rel="apple-touch-icon" sizes="57x57" href="/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="/img/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body>
    <div class="container b-main">
        <nav class="navbar navbar-inverse b-nav">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand b-logo" href="/">
                    <span class="sr-only">Brauwelt Brewery</span>
                </a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Схема проезда</a></li>
                    <li><a href="#">Оставить заявку</a></li>
                </ul>
            </div>
        </nav>
        <div class="b-photocontainer">
            <img src="/img/photo.jpg" class="b-photo" />
            <div class="b-phone">
                <span class="glyphicon glyphicon-phone-alt" aria-hidden="true"></span>
                &nbsp;
                +7(912)774-94-24
            </div>
            <div class="b-address">
                ПИВОВАРНЯ БРАУВЕЛЬТ<br />
                г. Челябинск,<br /> ул. Солнечная, д. 6-в
            </div>
        </div>
        <div class="b-section" style="background: #9d202f;">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">DARK BOCK</h1>
                    <h2 class="b-section__title_second">DARK BEER</h2>
                    <p>Темное пиво с ароматом вина и чернослива, мягкое на вкус с ореховым оттенком и сухим завершением.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый,
                    солод ячменный карамельный, солод
                    ячменный жженный, хмель, дрожжи
                    пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <p><a href="#" class="btn btn-default btn-lg">Оставить заявку</a></p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_1.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_1.png">
                </div>
            </div>
        </div>
    </div>
</body>
</html>