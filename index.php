<?php
header('Content-type: text/html; charset=utf-8');
error_reporting(0);
session_start();

define('SALT', '#V%$34b 07-i3,WB');
define('HASH1', '5a4539ff4cabbc7ad8d853bad351778f');
define('HASH2', 'a438ca8ff7950f691dbcee0cebba119b');

$aData  = json_decode(file_get_contents('lib/data.json'));

if (isset($_GET['auth'])) {
    sleep(2);
    if (isset($_POST['login']) && (md5($_POST['login'].SALT) === HASH1) && isset($_POST['password']) && (md5($_POST['password'].SALT) === HASH2)) {
        $_SESSION['auth']   = true;
    }
    header('Location: /');
    die();
}

if (isset($_GET['logout'])) {
    unset($_SESSION['auth']);
    header('Location: /');
    die();
}

if (isset($_GET['save'])) {
    if (isset($_SESSION['auth']) && $_SESSION['auth']) { //save action
        if ($_POST['optionsRadios'] == 'true') {
            $aData->$_POST['id'] = true;
        } else {
            $aData->$_POST['id'] = strtotime($_POST['date']);
        }
        $r  = fopen('lib/data.json', 'w');
        fwrite($r, json_encode($aData));
        fclose($r);
    }
    header('Location: /'.($_POST['id']?'#section_'.$_POST['id']:''));
    die();
}

if (isset($_GET['send'])) {
    require 'lib/PHPMailerAutoload.php';
    
    $sText  = "<ul>\n";
    foreach ($_POST['beer'] as $aVal) {
        $sText  .= "<li>".htmlspecialchars(trim($aVal['title'])).", кол-во: ".intval(trim($aVal['count']))." бут.</li>\n";
    }
    $sText  .= "<ul>\n";
    
    $oMail = new PHPMailer;
    $oMail->setFrom('noreply@'.$_SERVER['HTTP_HOST'], 'robot (noreply)');
    $oMail->addAddress('serg.brauwelt@yandex.ru', 'Serg Brauwelt');
    $oMail->Subject = 'Заявка с сайта';
    $oMail->CharSet = 'utf-8';
    $oMail->msgHTML('
<p>Дата формирования заявки: '.date('H:i, d.m.Y').'</p>
<p>Имя отправителя: '.htmlspecialchars($_REQUEST['name']).'</p>
<p>Содержание заявки: '.$sText.'</p>
<p>Контактная информация: '.nl2br(htmlspecialchars($_REQUEST['contact'])).'</p>');

    if (!$oMail->send()) {
        die('false');
    } else {
        die('true');
    }  
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=720, initial-scale=1" />
    <title>Brauwelt Brewery &mdash; крафтовое пиво в Челябинске</title>
    
    <link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/css/common.css" rel="stylesheet" />
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script src="/js/common.js"></script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
    
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
    
    <meta name="description" content="Самое лучшее и свежее крафтовое пиво в Челябинске\n тел.: +7(912)774-94-24\n г. Челябинск, ул. Солнечная, д. 6-в">
    <link rel="image_src" href="/img/photo.jpg" />
    
    <? if (isset($_SESSION['auth']) && $_SESSION['auth']) :?>
    <link href="/css/zebra_datepicker/bootstrap.css" rel="stylesheet" />
    <script src="/js/zebra_datepicker.js"></script>
    <? endif;?>
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
                <div class="addthis_toolbox addthis_default_style addthis_16x16_style b-addthis" 
                    addthis:url="http://<?=$_SERVER['HTTP_HOST']?>/"
                    addthis:description="Самое лучшее и свежее крафтовое пиво в Челябинске
                    тел.: +7(912)774-94-24
                    г. Челябинск, ул. Солнечная, д. 6-в"
                    addthis:image="/img/photo.jpg"
                    addthis:title="Brauwelt Brewery">
                    <a class="addthis_button_vk"></a>
                    <a class="addthis_button_odnoklassniki_ru"></a>
                    <a class="addthis_button_mymailru"></a>
                    <a class="addthis_button_facebook"></a>
                    <a class="addthis_button_compact"></a>
                </div>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" data-toggle="modal" data-target="#modal_map">Схема проезда</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal_send">В корзину</a></li>
                    <? if (isset($_SESSION['auth']) && $_SESSION['auth']) :?>
                        <li><a href="?logout=1">Выход</a></li>
                    <? endif;?>
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
        <div class="b-promo">
            <p>Cпециальная линейка сортов пивоварни Brauwelt сварена в ограниченном количестве для истинных ценителей пива.</p>
            <p>Термин «Craft», означающее «Ремесло», напрямую относится к нашей мини-пивоварни, т.к. мы стремимся создавать И Н Т Е Р Е С Н Ы Е сорта, с целью познакомить Вас с
            многочисленными стилями пива.</p>
            <p><strong>Наше пиво, в любом случае, не оставит вас равнодушными!</strong></p>
        </div>
        <div class="b-section" style="background: #ba5619;" id="section_sitra">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">﻿﻿﻿EXTRA CITRA</h1>
                    <h2 class="b-section__title_second">IPA</h2>
                    <p>Пиво в стиле IPA с упором на хмель Citra. Щедрое количество этого хмеля использовано на сухое охмеление, что придало яркий аромат тропических фруктов. Солодовая сладость умело скрывает 85IBU и раскрывает нотки тех же тропиков.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">16% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">7% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">85 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="sitra" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->sitra === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->sitra);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="sitra">изменить</button>':''?>
                    </p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_9.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_9.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #3b0300;" id="section_hopwood">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_10.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_10.png">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">HOP&WOOD</h1>
                    <h2 class="b-section__title_second">STRONG LAGER</h2>
                    <p>Эксперементальный сорт - хорошо охмеленный лагер, сброженный на щепе дуба. В итоге, получилось пиво янтарного цвета с ярким ароматом цветочного меда. Вкус вяленного яблока, груши с явственной горечью в завершении.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">15% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">6% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">8.0 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="hopwood" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->hopwood === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->hopwood);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="hopwood">изменить</button>':''?>
                    </p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #00514c;" id="section_greenwich">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">GREENWICH</h1>
                    <h2 class="b-section__title_second">ENGLISH STRONG ALE</h2>
                    <p>Рубиновый эль с ароматом красного вина и нотками черешни. Во вкусе продолжается винно-черешнивая тема, переходящая в сухую умеренную горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод
                    ячменный карамельный, солод ячменный жженный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">17% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">6% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">50 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="greenwich" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->greenwich === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->greenwich);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="greenwich">изменить</button>':''?>
                    </p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_1.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_1.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #003282;" id="section_belgian">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_2.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_2.png">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">BELGIAN</h1>
                    <h2 class="b-section__title_second">BLONDE ALE</h2>
                    <p>Крепкий светлый эль в Бельгийском стиле. Аромат цитрусово-хмелевой. Во вкусе, так же, различаются сладковато-цитрусовые нотки с легкой хмелевой горечью.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">13,5% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">5% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">25 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="belgian" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->belgian === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->belgian);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="belgian">изменить</button>':''?>
                    </p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #e0ddd7;" id="section_indian">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">INDIAN</h1>
                    <h2 class="b-section__title_second">PALE ALE</h2>
                    <p>Хорошо охмеленное пиво верхового брожения. В аромате цитрусовая тема дополняется хвойными нотками. На вкус карамельные тона с умеренным горьким завершением.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">13% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">5% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">55 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="indian" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->indian === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->indian);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="indian">изменить</button>':''?>
                    </p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_3.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_3.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #164c2a;" id="section_apa">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_4.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_4.png">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">APA</h1>
                    <h2 class="b-section__title_second">SINGLE HOP EQUINOX</h2>
                    <p>Сварен с использованием благородного Американского хмеля Equinox. Аромат: цитрусово-хвойно-яблочный. Вкус легкий фруктово-хмелевой. Горечь средняя.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">14% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">5,5% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">40 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="apa" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->apa === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->apa);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="apa">изменить</button>':''?>
                    </p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #e0d8c8;" id="section_amber">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">AMBER</h1>
                    <h2 class="b-section__title_second">ALE</h2>
                    <p>Рубинно-красный эль с карамельными нотками во вкусе, легкая хмелевая горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">14% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">6% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">30 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="amber" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->amber === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->amber);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="amber">изменить</button>':''?>
                    </p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_5.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_5.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #0d7239;" id="section_hawaii">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_6.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_6.png">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">HAWAII</h1>
                    <h2 class="b-section__title_second">PALE ALE</h2>
                    <p>Легкий сезонный эль янтарного цвета. Во вкусе медово-солодовая сладость с небольшой горьчинкой в завершении.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">12% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">4,5% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">27 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="hawaii" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->hawaii === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->hawaii);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="hawaii">изменить</button>':''?>
                    </p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #f57f24;" id="section_citrus">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">CITRUS</h1>
                    <h2 class="b-section__title_second">BELGIAN WHEAT</h2>
                    <p>Аромат тропических фруктов. Во вкусе преобладают манго-апельсиновые нотки. В завершении грейпфрутовая горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, апельсиновая цедра, кориандр, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">12% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">4,5% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">35 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="citrus" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->citrus === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->citrus);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="citrus">изменить</button>':''?>
                    </p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_7.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_7.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #f2d5aa;" id="section_porter">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-black"></div>
                    <img class="b-bottle__label" src="/img/label_8.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_8.png">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">PORTER</h1>
                    <h2 class="b-section__title_second">DARK BEER</h2>
                    <p>Темное пиво с портвейно-ореховым ароматом. Солодовая сладость во вкусе со смесью чернослива, орехов и ликера.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, солод ячменный жженый, хмель, пивные дрожжи.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Плотность</div>
                            <div class="b-sort__value">16% OG</div>
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Алкоголь</div>
                            <div class="b-sort__value">6% ABV</div>                        
                        </div>
                        <div class="col-xs-4">
                            <div class="b-sort__ttl">Горечь</div>
                            <div class="b-sort__value">30 IBU</div>
                        </div>
                    </div>
                    <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="porter" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                        &nbsp;
                        <?=$aData->porter === true ? 'в наличии' : 'ожидается '.date('d.m.Y', $aData->porter);?>
                        <?=$_SESSION['auth'] ? '<button class="btn btn-primary btn-sm change_btn" data-id="porter">изменить</button>':''?>
                    </p>
                </div>
            </div>
        </div>
        <footer class="b-footer">
            <div class="row">
                <div class="col-sm-6">
                    <p>Рассказать друзьям:</p>
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style" 
                        addthis:url="http://<?=$_SERVER['HTTP_HOST']?>/"
                        addthis:description="Самое лучшее и свежее крафтовое пиво в Челябинске
                        тел.: +7(912)774-94-24
                        г. Челябинск, ул. Солнечная, д. 6-в"
                        addthis:image="/img/photo.jpg"
                        addthis:title="Brauwelt Brewery">
                        <a class="addthis_button_vk"></a>
                        <a class="addthis_button_odnoklassniki_ru"></a>
                        <a class="addthis_button_mymailru"></a>
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_compact"></a>
                    </div>
                </div>
                <div class="col-sm-6 text-right">
                    2015 &copy; Brauwelt Brewery &mdash; крафтовое пиво в Челябинске<br />
                    тел.: +7(912)774-94-24<br />
                    г. Челябинск, ул. Солнечная, д. 6-в 
                </div>
            </div>
        </footer>
    </div>
    
    <div class="modal fade" id="modal_map" tabindex="-1" role="dialog" aria-labelledby="modal_map_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_map_label">Схема проезда</h4>
                </div>
                <div class="modal-body">
                    <p>По всем возникшим вопросам звоните по телефону: <strong>+7(912)774-94-24</strong></p>
                    <div id="map_container" style="width: 570px; height: 400px;" data-map="55.204464 61.317429" data-title="Brauwelt Brewery"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modal_send" tabindex="-1" role="dialog" aria-labelledby="modal_send_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_send_label">Оставить заявку</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="?send=1" id="mesForm">
                        <div class="form-group">
                            <label for="inpName">Ваше имя:</label>
                            <input type="text" name="name" class="form-control" id="inpName" placeholder="Имя">
                            <p class="help-block error-block hide">Заполните поле</p>
                        </div>
                        <div class="form-group">
                            <label for="inpText">Содержание заявки:</label>
                            <div class="form-inline">
                                <div class="form-group" id="beerSelectPanel">
                                    <select id="beerSelect" class="form-control">
                                        <option value="sitra" data-img="/img/label_9.png" selected="selected">EXTRA CITRA IPA</option>
                                        <option value="hopwood" data-img="/img/label_10.png">HOP&WOOD Strong Lager</option>
                                        <option value="greenwich" data-img="/img/label_1.png">GREENWICH English Strong Ale</option>
                                        <option value="belgian" data-img="/img/label_2.png">BELGIAN Blonde Ale</option>
                                        <option value="indian" data-img="/img/label_3.png">INDIAN Pale Ale</option>
                                        <option value="apa" data-img="/img/label_4.png">APA Single Hop Equinox</option>
                                        <option value="amber" data-img="/img/label_5.png">AMBER Ale</option>
                                        <option value="hawaii" data-img="/img/label_6.png">HAWAII Pale Ale</option>
                                        <option value="citrus" data-img="/img/label_7.png">CITRUS Belgian Wheat</option>
                                        <option value="porter" data-img="/img/label_8.png">PORTER Dark Beer</option>
                                    </select> 
                                    <button type="button" class="btn btn-success" id="beerAdd">добавить</button>
                                    <p class="help-block error-block hide">Выберите хотя бы одну позицию</p>
                                </div>
                            </div>
                            <div id="beerList" class="b-beerlist"></div>
                        </div>
                        <div class="form-group">
                            <label for="inpCont">Ваши комментарии к заказу и контактная информация:</label>
                            <textarea class="form-control" name="contact" id="inpCont" rows="5"></textarea>
                            <p class="help-block error-block hide">Заполните поле</p>
                            <p class="help-block">Пожалуйста, перечислите ваши контактные данные в поле выше, чтобы мы могли в скором времени связаться с вами</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modalBtns">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Свернуть</button>
                    <button type="button" class="btn btn-primary" id="mesSend">Отправить</button>
                </div>
            </div>
        </div>
    </div>

    <? if (isset($_GET['login_action'])) :?>
        <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modal_logn_label">
            <div class="modal-dialog" role="document">
                <form method="post" action="?auth=1" id="loginForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_logn_label">Авторизация</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="inpName">Логин:</label>
                            <input type="text" name="login" class="form-control" placeholder="Логин">
                        </div>
                        <div class="form-group">
                            <label for="inpText">Пароль:</label>
                            <input type="password" name="password" class="form-control" placeholder="Пароль">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary" id="loginSend">Отправить</button>
                    </div>
                </div>
                </form>
            </div>
        </div>

        <script type="text/javascript">
            $(function(){
                $('#modal_login').modal('show');
            });
        </script>
    <? endif;?>
    
    <? if (isset($_SESSION['auth']) && $_SESSION['auth']) :?>
        <div class="modal fade" id="modal_change" tabindex="-1" role="dialog" aria-labelledby="modal_change_label">
            <div class="modal-dialog" role="document">
                <form method="post" action="?save=1" id="changeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="modal_change_label">Изменить</h4>
                    </div>
                    <div class="modal-body">
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios1" value="true" checked="checked">
                            в наличии
                          </label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="optionsRadios" id="optionsRadios2" value="false">
                            ожидается <input type="text" name="date" value="<?=date('d.m.Y');?>" id="datepick" />
                          </label>
                        </div>
                        <input type="hidden" name="id" value="" id="save_id_holder" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary" id="changeSend">Сохранить</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        
        <script type="text/javascript">
            $(function(){
                $('#modal_change').on('shown.bs.modal', function(){
                    $('#datepick').Zebra_DatePicker({
                        format: 'd.m.Y'
                    });
                });
                
                $('#datepick').on('click', function(){
                    $('#optionsRadios2').prop('checked', true);
                });

                $(document).on('click', '.change_btn', function(){
                    $('#modal_change').modal('show');
                    $('#save_id_holder').val( $(this).data('id') );
                })
            });
        </script>
    <? endif;?>
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-69007114-1', 'auto');
        ga('send', 'pageview');
        
        <?=isset($_GET['resend'])?'$(function(){$("#modal_send").modal("show");});':''?>
    </script>
</body>
</html>