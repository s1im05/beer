<div class="b-locations">
    <div class="row">
        <div class="col-sm-12">
            <div class="b-map__big" id="ymap"></div>
        </div>
    </div>
    <? foreach ($aPlaces as $aVal) :?>
    <div class="row" id="places">
        <div class="col-sm-12">
            <div class="b-place" data-map="<?=htmlspecialchars($aVal['map'])?>" data-title="<?=htmlspecialchars($aVal['title'])?>">
                <h3><strong><?=$aVal['title']?></strong></h3>
                <? if ($aVal['text']) :?>
                    <h4><?=$aVal['text']?></h4>
                <? endif; ?>
                <div class="row text-muted">
                    <? if ($aVal['address']) :?>
                        <div class="col-sm-6">
                            <?=$aVal['address']?>
                            <? if ($aVal['map']) :?>
                                <br /><a href="#ymap" class="btn btn-xs btn-default b-goto" data-goto="<?=$aVal['map']?>">показать на карте</a>
                            <? endif;?>
                        </div>
                    <? endif; ?>
                    <? if ($aVal['phone']) :?>
                        <div class="col-sm-2"><i class="fa fa-phone"></i> <?=$aVal['phone']?></div>
                    <? endif; ?>
                    <? if ($aVal['web']) :?>
                        <div class="col-sm-4"><i class="fa fa-external-link"></i> <a target="_blank" href="http://<?=$aVal['web']?>"><?=$aVal['web']?></a></div>
                    <? endif; ?>
                </div>
            </div>
        </div>
    </div>
    <? endforeach; ?>
</div>

<script type="text/javascript">
    // Yandex-maps API
    var myMap;
    ymaps.ready(function(){
        var jqMapContainer  = $('#ymap');

        myMap   = new ymaps.Map(jqMapContainer.attr('id'), {
            'center':  [55.160, 61.401], 
            'zoom': 10
        });
            
        $('#places .b-place').each(function(){
            var a = $(this).data('map').split(' ');
            a.push(a.shift());
            if (a.length == 2){
                var myPlacemark = new ymaps.Placemark(a, { 
                    'hintContent': $(this).data('title'), 
                    'balloonContent': $(this).data('title')
                });
                myMap.geoObjects.add(myPlacemark);
            }
        });
    });
    
    $(function(){
        $(document).on('click', '.b-goto', function(e){
            var a = $(this).data('goto').split(' ');
            a.push(a.shift());
            myMap.setCenter(a, 15);
        });
    });
</script>