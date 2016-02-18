<? foreach ($aData as $aBeer) :?>
<div class="b-section" style="background: #<?=$aBeer['color']?>;" id="section_<?=$aBeer['id']?>">
    <div class="row">
        <div class="b-section__text col-xs-6 col-xs-offset-1">
            <h1 class="b-section__title"><?=$aBeer['title']?></h1>
            <h2 class="b-section__title_second"><?=$aBeer['title_sub']?></h2>
            <p><?=nl2br($aBeer['text'])?></p>
            <p><strong>Хранить при температуре</strong> от 1 до 6 градусов.</p>
            <div class="row">
                <div class="col-xs-4">
                    <div class="b-sort__ttl">Плотность</div>
                    <div class="b-sort__value"><?=$aBeer['og']?>% OG</div>
                </div>
                <div class="col-xs-4">
                    <div class="b-sort__ttl">Алкоголь</div>
                    <div class="b-sort__value"><?=$aBeer['abv']?>% ABV</div>                        
                </div>
                <div class="col-xs-4">
                    <div class="b-sort__ttl">Горечь</div>
                    <div class="b-sort__value"><?=$aBeer['ibu']?> IBU</div>
                </div>
            </div>
            <p><a href="#" class="btn btn-default btn-lg b-sendbtn" data-id="<?=$aBeer['id']?>" data-toggle="modal" data-target="#modal_send">Оставить заявку</a>
                &nbsp;
                <?=$aBeer['available'] == '1' ? 'в наличии' : 'ожидается '.date('d.m.Y', strtotime($aBeer['date_e']));?>
            </p>
        </div>
        <div class="b-section__bottle col-xs-5">
            <div class="b-bottle b-bottle-<?=$aBeer['type']?>"></div>
            <img class="b-bottle__label" src="<?=$aBeer['image']?>">
            <img class="b-bottle__label-bg" src="<?=$aBeer['image']?>">
        </div>
    </div>
</div>
<? endforeach;?>