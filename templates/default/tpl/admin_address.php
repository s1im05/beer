<p>
    <button class="btn btn-success" id="add_address">Добавить адрес</button>
    <button class="btn btn-default hidden" id="save_order">Сохранить порядок</button>
</p>
<? if ($aData) :?>
    <div id="sortable">
    <? foreach ($aData as $aVal) :?>
        <div class="panel panel-default sortable" data-id="<?=$aVal['id']?>">
            <div class="panel-heading">
                <?=$aVal['title']?>
            </div>
            <div class="panel-body">
                <p><strong>Описание:</strong> <?=$aVal['text']?></p>
                <p><strong>Адрес:</strong> <?=$aVal['address']?></p>
                <p>
                    <strong>Телефон:</strong> <?=$aVal['phone']?$aVal['phone']:'не указан'?>;
                    <strong>Адрес в интернете:</strong> <?=$aVal['web']?'<a href="http://'.$aVal['web'].'" target="_blank">'.$aVal['web'].'</a>':'не указан'?>;
                    <strong>Координаты на Яндекс-картах:</strong> <?=$aVal['map']?$aVal['map']:'не указаны'?>;
                </p>
                <p>
                    <button class="btn btn-primary edit">Редактировать свойства</button>
                    <button class="btn btn-danger place_delete">Удалить</button>
                </p>
            </div>
        </div>
    <? endforeach?>
    </div>
<? else :?>
    <p>Нет данных для отображения</p>
<? endif;?>


<div class="modal fade" tabindex="-1" role="dialog" id="addAddress">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data" id="addAddressForm">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" required="required" id="title" name="title" placeholder="Заголовок">
                </div>
                <div class="form-group">
                    <label for="text">Описание</label>
                    <textarea class="form-control" required="required" id="text" name="text" placeholder="Описание"></textarea>
                </div>
                <div class="form-group">
                    <label for="address">Адрес</label>
                    <textarea class="form-control" required="required" id="address" name="address" placeholder="Адрес"></textarea>
                </div>
                <div class="form-group">
                    <label for="map">Координаты для карты</label>
                    <div class="input-group">
                        <input type="text" placeholder="Координаты для карты" id="map" name="map" class="form-control input-sm"> 
                        <span class="input-group-addon btn b-search__btn" id="get_geo">вычислить по адресу</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="web">Адрес сайта</label>
                    <input type="text" class="form-control" id="web" name="web" placeholder="Адрес сайта">
                    <p class="help-block">вводить без http:// и www.</p>
                </div>
                <div class="form-group">
                    <label for="phone">Телефон</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Телефон">
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" value="0">
                <button type="submit" class="btn btn-primary">Сохранить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
        </form>
    </div>
</div>



<script type="text/javascript">
    $(function(){
        
        var btnDisable  = function(btn){
                $(btn).prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin" /> ');
            },
            btnEnable  = function(btn){
                return $(btn).prop('disabled', false).find('.fa').remove().end();
            };
            
        $("#sortable").sortable({
            'stop': function(){
                if ($('#sortable > *').length > 1){
                    $('#save_order').removeClass('hidden');
                }
            }
        });
        
        $('#save_order').on('click', function(e){
            e.preventDefault();
            btnDisable(this);
            
            var iCnt    = 0,
                tmp     = function saveSort(jqThis){
                $.post('/adm_panel/address', {
                    'pos':  iCnt++,
                    'id':   jqThis.data('id')
                }, function(){
                    if (jqThis.next().length){
                        saveSort(jqThis.next());
                    } else {
                        btnEnable($('#save_order')).addClass('hidden')
                    }
                });
                
            }($('#sortable > *:first'));
        });
        
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var sId     = $(this).closest('.panel').data('id'),
                self    = this;
            btnDisable(this);
            $.get('/adm_panel/address', {'place': sId}, function(data){
                if (data){
                    for (var sKey in data){
                        var inpt    = $('#addAddressForm').find(':input[name='+sKey+']');
                        inpt.val(data[sKey]).trigger('input').trigger('change');
                    }
                    $('#addAddress').modal();
                }
                btnEnable(self);
            }, 'json');
        });
        
        $(document).on('click tap', '.place_delete', function(e){
            e.preventDefault();
            if (confirm('Вы действительно хотите удалить адрес?')){
                btnDisable(this);
                var jqParent    = $(this).closest('.panel');
                
                $.post('/adm_panel/address?delete=1', {
                    'id':   jqParent.data('id')
                }, function(){
                    jqParent.remove();
                });
            }
        });
        
        $('#get_geo').on('click', function(e){
            if ($(this).prop('disabled')) return;
            
            if ($('#address').val()){
                btnDisable(this);
                var self = this;
                
                $.getJSON('http://geocode-maps.yandex.ru/1.x/?',{
                    'geocode': 'г.Челябинск, '+$('#address').val(),
                    'format':'json'
                }, function(data){
                    if (data && data.response.GeoObjectCollection.featureMember !== undefined && data.response.GeoObjectCollection.featureMember.length) {
                        $('#map').val(data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos);
                        btnEnable(self);
                    } else {
                        alert('К сожалению, по вашему запросу ничего не найдено');
                    }
                });
            } else {
                alert('Невозможно определить координаты. Сперва заполните поле "Адрес"');
            }
        });
        
        $('#add_address').on('click', function(e){
            e.preventDefault();
            $("#addAddressForm")[0].reset();
            $("#addAddressForm :input[name=id]").val(0);
            $("#addAddressForm :input").trigger('change').trigger('input');
            $('#addAddress').modal();
        });
    });
</script>