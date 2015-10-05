ymaps.ready(function (){
    var jqMapContainer  = $('#map_container');
    if (!jqMapContainer.data('map-loaded') && jqMapContainer.data('map')) {
        var myMap   = new ymaps.Map(jqMapContainer.attr('id'), {
            center:  jqMapContainer.data('map').split(' '), 
            zoom: 16
        }), myPlacemark = new ymaps.Placemark(jqMapContainer.data('map').split(' '), { 
            hintContent: jqMapContainer.data('title'), 
            balloonContent: jqMapContainer.data('title')
        });
        myMap.geoObjects.add(myPlacemark);
        jqMapContainer.data('map-loaded', true);
    }    
});