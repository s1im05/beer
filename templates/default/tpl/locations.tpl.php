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
                        <div class="col-sm-6"><?=$aVal['address']?></div>
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
$(function(){
    // Yandex-maps API
    ymaps.ready(function(){
        var jqMapContainer  = $('#ymap');
        if (!jqMapContainer.data('map-loaded')) {
            var myMap   = new ymaps.Map(jqMapContainer.attr('id'), {
                center:  [55.160283,61.400856], 
                zoom: 10
            });
            jqMapContainer.data('map-loaded', true);
            
            $('#places .b-place').each(function(){
                var a = $(this).data('map').split(' ');
                a.push(a.shift());
                var myPlacemark = new ymaps.Placemark(a, { 
                    hintContent: $(this).data('title'), 
                    balloonContent: $(this).data('title')
                });
                myMap.geoObjects.add(myPlacemark);
            });
        }    
    });
});
</script>