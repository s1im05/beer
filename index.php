<?php
header('Content-type: text/html; charset=utf-8');

if (isset($_GET['send'])) {
    require 'lib/PHPMailerAutoload.php';

    $oMail = new PHPMailer;
    $oMail->setFrom('noreply@beer.vsul.ru', 'robot (noreply)');
    $oMail->addAddress('s1im05@mail.ru', 'Vadim Suleimanov');
    $oMail->Subject = 'Заявка с сайта';
    $oMail->CharSet = 'utf-8';
    $oMail->msgHTML('
<p>Дата формирования заявки: '.date('H:i, d.m.Y').'</p>
<p>Имя отправителя: '.htmlspecialchars($_REQUEST['name']).'</p>
<p>Содержание заявки: '.nl2br(htmlspecialchars($_REQUEST['text'])).'</p>
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
                    addthis:url="/"
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
                    <li><a href="#" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></li>
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
        <div class="b-section" style="background: #00514c;">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text col-xs-6">
                    <h1 class="b-section__title">GREENWICH</h1>
                    <h2 class="b-section__title_second">ENGLISH STRONG ALE</h2>
                    <p>Рубиновый эль с ароматом красного вина и нотками черешни. Во вкусе продолжается винно-черешнивая тема, переходящая в сухую умеренную горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод
                    ячменный карамельный, солод ячменный жженный, хмель,дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <p><strong>OG</strong> 17% &nbsp; <strong>АBV</strong> 6%</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_1.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_1.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #003282;">
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
                    <p><strong>OG</strong> 13,5% &nbsp; <strong>АBV</strong> 5% &nbsp; <strong>IBU</strong> 25</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #e0ddd7;">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">INDIAN</h1>
                    <h2 class="b-section__title_second">PALE ALE</h2>
                    <p>Хорошо охмеленное пиво верхового брожения. В аромате цитрусовая тема дополняется хвойными нотками. На вкус карамельные тона с умеренным горьким завершением.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <p><strong>OG</strong> 13% &nbsp; <strong>АBV</strong> 5% &nbsp; <strong>IBU</strong> 55</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle"></div>
                    <img class="b-bottle__label" src="/img/label_3.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_3.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #164c2a;">
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
                    <p><strong>OG</strong> 14% &nbsp; <strong>АBV</strong> 5,5% &nbsp; <strong>IBU</strong> 40</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #e0d8c8;">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">AMBER</h1>
                    <h2 class="b-section__title_second">ALE</h2>
                    <p>Рубинно-красный эль с карамельными нотками во вкусе, легкая хмелевая горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, солод ячменный карамельный, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <p><strong>OG</strong> 14% &nbsp; <strong>АBV</strong> 6% &nbsp; <strong>IBU</strong> 30</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_5.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_5.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #0d7239;">
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
                    <p><strong>OG</strong> 12% &nbsp; <strong>АBV</strong> 4,5% &nbsp; <strong>IBU</strong> 27</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #f57f24;">
            <div class="row">
                <div class="b-section__text col-xs-1">
                </div>
                <div class="b-section__text b-section__text-black col-xs-6">
                    <h1 class="b-section__title">CITRUS</h1>
                    <h2 class="b-section__title_second">BELGIAN WHEAT</h2>
                    <p>Аромат тропических фруктов. Во вкусе преобладают манго-апельсиновые нотки. В завершении грейпфрутовая горечь.</p>
                    <p><strong>Состав:</strong> Солод ячменный светлый, апельсиновая цедра, кориандр, хмель, дрожжи пивные.</p>
                    <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
                    <p><strong>OG</strong> 12% &nbsp; <strong>АBV</strong> 4,5% &nbsp; <strong>IBU</strong> 35</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
                <div class="b-section__bottle col-xs-5">
                    <div class="b-bottle b-bottle-red"></div>
                    <img class="b-bottle__label" src="/img/label_7.png">
                    <img class="b-bottle__label-bg" src="/img/label_bg_7.png">
                </div>
            </div>
        </div>
        <div class="b-section" style="background: #f2d5aa;">
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
                    <p><strong>OG</strong> 16% &nbsp; <strong>АBV</strong> 6% &nbsp; <strong>IBU</strong> 30</p>
                    <p><a href="#" class="btn btn-default btn-lg" data-toggle="modal" data-target="#modal_send">Оставить заявку</a></p>
                </div>
            </div>
        </div>
        <footer class="b-footer">
            <div class="row">
                <div class="col-sm-6">
                    <p>Рассказать друзьям:</p>
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style" 
                        addthis:url="/"
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
                            <textarea class="form-control" name="text" id="inpText" rows="5"></textarea>
                            <p class="help-block error-block hide">Заполните поле</p>
                        </div>
                        <div class="form-group">
                            <label for="inpCont">Контактная информация:</label>
                            <textarea class="form-control" name="contact" id="inpCont" rows="5"></textarea>
                            <p class="help-block error-block hide">Заполните поле</p>
                            <p class="help-block">Пожалуйста, перечислите ваши контактные данные, чтобы мы могли в скором времени связаться с вами</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modalBtns">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary" id="mesSend">Отправить</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>