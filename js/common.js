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
        $('#mesForm input, #mesForm textarea').each(function(){
            if ($(this).val() == '') {
                $(this).closest('.form-group').addClass('has-error').find('.error-block').removeClass('hide');
                err = true;
            }
        });
        if ($('#beerList .row').length === 0) {
            $('#beerSelectPanel').addClass('has-error').find('.error-block').removeClass('hide');
            err = true;
        }
        if (err) return;
        
        var oData   = {
            'name': $('#inpName').val(),
            'contact': $('#inpCont').val(),
            'beer': []
        };
        $('#beerList .row').each(function(){
            oData.beer.push({
                'title': $(this).children('.b-beerlist__item').text(),
                'count': $(this).find('input:first').val()
            });
        });
        
        $('#modalBtns').html('<img src="/img/ajax.gif" alt="Отправка...">');
        $.ajax({
            url: $('#mesForm').attr('action'),
            method: 'post',
            data: oData,
            success: function(sData){
                $('#modalBtns').html('<button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>');
                if (sData == 'true') {
                    $('#mesForm').html('<p>Ваша заявка была успешно отправлена!</p><p>В ближайшее время мы свяжемся с вами для обсуждения деталей вашего заказа.</p><p><a href="?resend=1">Отправить</a> еще одну заявку</p>');
                } else {
                    $('#mesForm').html('<p>Проблема при отправке заявки</p><p>По техническим причинам не удалось отправить вашу заявку. Просьба, <a href="?resend=1">обновить страницу</a> и попробовать отправить заявку позже.</p>');
                }
            }
        });
    });
    
    $('#mesForm').on('submit', function(){
        e.preventDefault();
        $('#mesSend').trigger('click');
    }).on('change keypress', ':input', function(){
        $(this).closest('.form-group').removeClass('has-error').find('.error-block').addClass('hide');
    });
    
    $('#beerAdd').on('click', function(e){
        e.preventDefault();
        var jqSel   = $('#beerSelect option:selected');
        $('#beerList').append('<div class="row form-group b-beerlist__row" data-id="'+jqSel.attr('value')+'"><div class="col-xs-6 b-beerlist__item"><img class="b-beerlist__img" src="'+jqSel.data('img')+'" alt="'+jqSel.text()+'">'+jqSel.text()+'</div> \
        <div class="col-xs-4 text-right"><input type="number" placeholder="кол-во бутылок" class="form-control"> \
        <p class="help-block error-block hide">укажите кол-во</p></div> \
        <div class="col-xs-2 text-right"><button class="btn btn-default b-deletebtn"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button></div></div>');
        jqSel.prop('disabled', true);
        if ( $('#beerSelect option:not(:disabled)').length === 0 ) {
            $('#beerSelectPanel').hide();
        } else {
            $('#beerSelect option:not(:disabled):first').prop('selected', true);
        }
        $('#beerSelectPanel').removeClass('has-error').find('.error-block').addClass('hide');
    });
    
    $('#beerList').on('click', '.b-deletebtn', function(e){
        e.preventDefault();
        var jqRow   = $(this).closest('.row');
        $('#beerSelect option').each(function(){
            if (jqRow.data('id') === $(this).attr('value')) {
                $(this).prop('disabled', false);
            }
        });
        $('#beerSelectPanel').show();
        if ( $('#beerSelect option:not(:disabled)').length === 1 ) {
            $('#beerSelect option:not(:disabled):first').prop('selected', true);            
        }

        jqRow.remove();
    });
    
    $(document).on('click', '.b-sendbtn', function(){
        var sId = $(this).data('id');
        $('#beerSelect option').each(function(){
            if (sId === $(this).attr('value') && $(this).is(':not(:disabled)')) {
                $(this).prop('selected', true);
                $('#beerAdd').trigger('click');
            }
        });        
    });
});








