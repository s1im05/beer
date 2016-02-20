<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=720, initial-scale=1" />
    <title>Brauwelt Brewery &mdash; крафтовое пиво в Челябинске</title>
    
    <link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href="<?=$path?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?=$path?>/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?=$path?>/css/common.css" rel="stylesheet" />
    
    <script src="<?=$path?>/js/jquery.min.js"></script>
    <script src="<?=$path?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
    <script src="<?=$path?>/js/common.js"></script>
    <script type="text/javascript" src="//s7.addthis.com<?=$path?>/js/300/addthis_widget.js"></script>
    
    <link rel="apple-touch-icon" sizes="57x57" href="<?=$path?>/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?=$path?>/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?=$path?>/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?=$path?>/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?=$path?>/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?=$path?>/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?=$path?>/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?=$path?>/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=$path?>/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?=$path?>/img/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=$path?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?=$path?>/img/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=$path?>/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?=$path?>/img/favicon/manifest.json">
    
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?=$path?>/img/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    
    <meta name="description" content="Самое лучшее и свежее крафтовое пиво в Челябинске, тел.: +7(912)774-94-24, г. Челябинск, ул. Солнечная, д. 6-в">
    <link rel="image_src" href="<?=$path?>/img/photo.jpg" />
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
                    addthis:image="<?=$path?>/img/photo.jpg"
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
                    <li><a href="/">Заказ продукции</a></li>
                    <li><a href="/locations">Места продаж</a></li>
                    <li><a href="#" data-toggle="modal" data-target="#modal_map">Схема проезда</a></li>
                    <? if ($aData) :?>
                        <li><a href="#" data-toggle="modal" data-target="#modal_send">В корзину</a></li>
                    <? endif;?>
                </ul>
            </div>
        </nav>
        <div class="b-photocontainer">
            <img src="<?=$path?>/img/photo.jpg?v=1" class="b-photo" />
            <div class="b-phone">
                <i class="fa fa-envelope"></i>&nbsp;
                <a href="mailto:79127749424%40ya.ru">79127749424@ya.ru</a><br/>
                
                <i class="fa fa-phone-square"></i>&nbsp;
                +7(912)774-94-24<br />
                
                ПИВОВАРНЯ БРАУВЕЛЬТ<br />
                <small>г. Челябинск,<br /> ул. Солнечная, д. 6-в</small>
            </div>
            <div class="b-promo hidden-xs hidden-sm">
                <p>Cпециальная линейка сортов пивоварни Brauwelt сварена в ограниченном количестве для истинных ценителей пива</p>
                <p>Термин «Craft», означающее «Ремесло», напрямую относится к нашей мини-пивоварни, т.к. мы стремимся создавать <strong>интересные</strong> сорта, с целью познакомить Вас с
                многочисленными стилями пива</p>
                <p class="visible-lg">&nbsp;</p>
                <p><strong>Наше пиво, в любом случае, не оставит вас равнодушными!</strong></p>
            </div>
        </div>
        
        <? include $template;?>

        <footer class="b-footer">
            <div class="row">
                <div class="col-sm-6">
                    <p>Рассказать друзьям:</p>
                    <div class="addthis_toolbox addthis_default_style addthis_32x32_style" 
                        addthis:url="http://<?=$_SERVER['HTTP_HOST']?>/"
                        addthis:description="Самое лучшее и свежее крафтовое пиво в Челябинске
                        тел.: +7(912)774-94-24
                        г. Челябинск, ул. Солнечная, д. 6-в"
                        addthis:image="<?=$path?>/img/photo.jpg"
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
                    г. Челябинск, ул. Солнечная, д. 6-в <br />
                    <i class="fa fa-envelope"></i>&nbsp; <a href="mailto:79127749424%40ya.ru">79127749424@ya.ru</a><br />
                    <i class="fa fa-phone-square"></i>&nbsp; +7(912)774-94-24<br />
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
                    <p>Или отправляйте свои сообщения по email: <a href="mailto:79127749424%40ya.ru">79127749424@ya.ru</a></p>
                    <div id="map_container" data-sign="<?=$path?>/img/mapsign.png" style="width: 570px; height: 400px;" data-map="55.204464 61.317429" data-title="Brauwelt Brewery"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
    
    <? include 'cart.tpl.php';?>
    
    <script type="text/javascript">
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-69007114-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
</html>