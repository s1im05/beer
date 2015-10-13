ymaps.ready(function (){
    var jqMapContainer  = $('#map_container');
    if (!jqMapContainer.data('map-loaded') && jqMapContainer.data('map')) {
        var myMap   = new ymaps.Map(jqMapContainer.attr('id'), {
            center:  jqMapContainer.data('map').split(' '), 
            zoom: 16
        }), myPlacemark = new ymaps.Placemark(jqMapContainer.data('map').split(' '), { 
            hintContent: jqMapContainer.data('title'), 
            balloonContent: jqMapContainer.data('title')
        }, {
            iconLayout: 'default#image',
            iconImageHref: '/img/mapsign.png',
            iconImageSize: [47, 56],
            iconImageOffset: [-23, -56]
        });
        myMap.geoObjects.add(myPlacemark);
        jqMapContainer.data('map-loaded', true);
    }    
});

$(function(){
    $('#mesSend').on('click', function(e){
        var err = false;
        $('#mesForm :input').each(function(){
            if ($(this).val() == '') {
                $(this).parent('.form-group').addClass('has-error').find('.error-block').removeClass('hide');
                err = true;
            }
        });
        if (err) return;
        
        $('#modalBtns').html('<img src="/img/ajax.gif" alt="Отправка...">');
        $.ajax({
            url: $('#mesForm').attr('action'),
            method: 'post',
            data: $('#mesForm').serialize(),
            success: function(sData){
                $('#modalBtns').html('<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>');
                if (sData == 'true') {
                    $('#mesForm').html('<p>Ваша заявка была успешно отправлена!</p><p>В ближайшее время мы свяжемся с вами для обсуждения деталей вашего заказа.</p>');
                } else {
                    $('#mesForm').html('<p>Проблема при отправке заявки</p><p>По техническим причинам не удалось отправить вашу заявку. Просьба, обновить страницу и попробовать отправить заявку позже.</p>');
                }
            }
        });
    });
    
    $('#mesForm').on('submit', function(){
        e.preventDefault();
        $('#mesSend').trigger('click');
    }).on('change keypress', ':input', function(){
        $(this).parent('.form-group').removeClass('has-error').find('.error-block').addClass('hide');
    });
});