<p>
    <button class="btn btn-success" id="add_sort">Добавить сорт</button>
    <button class="btn btn-default hidden" id="save_order">Сохранить порядок</button>
</p>
<? if ($aData) :?>
    <div id="sortable">
    <? foreach ($aData as $aBeer) :?>
        <div class="panel panel-default sortable" data-id="<?=$aBeer['id']?>">
            <div class="panel-heading">
                <?=$aBeer['title']?> / <?=$aBeer['title_sub']?>
            </div>
            <div class="panel-body">
                <div class="media">
                    <div class="media-left">
                        <div class="bg" style="background: #<?=$aBeer['color']?>">
                            <img class="bg-img" src="<?=$aBeer['image']?>">
                        </div>
                    </div>
                    <div class="media-body">
                        <p><strong>Описание:</strong> <?=$aBeer['text']?></p>
                        <p>
                            <strong>Тип:</strong> <? $a = array('light' => 'светлое', 'red' => 'красное', 'dark' => 'темное'); echo $a[$aBeer['type']];?>, 
                            <strong>OG:</strong> <?=$aBeer['og']?>%, 
                            <strong>ABV:</strong> <?=$aBeer['abv']?>%, 
                            <strong>IBU:</strong> <?=$aBeer['ibu']?> 
                        </p>
                        <p>
                            <button class="btn btn-primary edit">Редактировать свойства</button>
                            <? if ($aBeer['show']):?>
                                <button class="btn btn-danger sort_toggle" data-show="0">Не отображать на сайте</button>
                            <? else :?>
                                <button class="btn btn-info sort_toggle" data-show="1">Отображать на сайте</button>
                            <? endif;?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <? endforeach?>
    </div>
<? else :?>
    <p>Нет данных для отображения</p>
<? endif;?>


<div class="modal fade" tabindex="-1" role="dialog" id="addSort">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data" id="addSortForm">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="form-group">
                    <label for="title">Заголовок</label>
                    <input type="text" class="form-control" required="required" id="title" name="title" placeholder="Заголовок">
                </div>
                <div class="form-group">
                    <label for="title_sub">Подзаголовок</label>
                    <input type="text" class="form-control" required="required" id="title_sub" name="title_sub" placeholder="Подзаголовок">
                </div>
                <div class="form-group">
                    <label for="text">Описание</label>
                    <textarea class="form-control" required="required" id="text" name="text" placeholder="Описание"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Обложка/изображение</label>
                    <input type="file" name="image" id="image">
                </div>
                <div class="form-group form-inline">
                    <label for="color">Цвет поля под обложкой</label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <span class="colorpicker-icon" id="color_icon"></span>
                        </span>
                        <input type="text" name="color" class="form-control" id="color" value="000000" maxlength="6" size="6">
                    </div>
                </div>
                <div class="form-group form-inline">
                    <label for="color">Цвет текста заголовка и описания сорта</label>
                    <div class="input-group">
                        <select name="text_color" class="form-control">
                            <option value="1" selected="selected">белый</option>
                            <option value="0">черный</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Тип пива для отображения</label>
                    <select name="type" class="form-control">
                        <option value="light">светлое</option>
                        <option value="red">красное</option>
                        <option value="dark">темное</option>
                    </select>
                </div>                
                <div class="form-group">
                    <label>Имеется в наличии</label>
                    <div class="form-inline">
                        <select name="available" class="form-control">
                            <option value="1">имеется</option>
                            <option value="0">ожидается</option>
                        </select>
                        <span id="date_e" class="hidden"><input type="text" class="form-control" id="date_e_input" name="date_e" value="<?=date('d.m.Y')?>"></span>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group">
                        <label for="og">OG</label>
                        <input type="text" class="form-control" id="og" name="og" placeholder="OG" size="4" maxlength="7" required="required">
                    </div>
                    <div class="form-group">
                        <label for="abv">ABV</label>
                        <input type="text" class="form-control" id="abv" name="abv" placeholder="ABV" size="4" maxlength="7" required="required">
                    </div>
                    <div class="form-group">
                        <label for="ibu">IBU</label>
                        <input type="text" class="form-control" id="ibu" name="ibu" placeholder="IBU" size="4" maxlength="7" required="required">
                    </div>
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
                $(btn).prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin" />&nbsp;');
            },
            btnEnable  = function(btn){
                return $(btn).prop('disabled', false).find('.fa').remove().end();
            };
            
        
        $(':input[name=available]').on('change', function(e){
            $(this).val() === '1' ? $('#date_e').addClass('hidden') : $('#date_e').removeClass('hidden');
        });
        
        $('#date_e_input').datepicker({
            'dateFormat': 'dd.mm.yy',
            'firstDay': 1
        });
        
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
                $.post('/adm_panel/beer', {
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
        
        $('#color').on('input', function(){
            $('#color_icon').css('background', '#'+$(this).val());
        });
        
        $('#add_sort').on('click', function(e){
            e.preventDefault();
            $("#addSortForm")[0].reset();
            $("#addSortForm :input").trigger('change').trigger('input');
            $("#addSortForm :input[name=id]").val(0);
            $('#addSort').modal();
        });
        
        $(document).on('click', '.edit', function(e){
            e.preventDefault();
            var sId     = $(this).closest('.panel').data('id'),
                self    = this;
            btnDisable(this);
            $.get('/adm_panel/beer', {'sort': sId}, function(data){
                if (data){
                    for (var sKey in data){
                        var inpt    = $('#addSortForm').find(':input[name='+sKey+']');
                        if (inpt.length && sKey !== 'image'){
                            inpt.val(data[sKey]).trigger('input').trigger('change');
                        }
                    }
                    $('#addSort').modal();
                }
                btnEnable(self);
            }, 'json');
        });
        
        $(document).on('click', '.sort_toggle', function(e){
            e.preventDefault();
            btnDisable(this);
            $.post('/adm_panel/beer',{
                'show': $(this).data('show'),
                'id':   $(this).closest('.panel').data('id')
            }, function(){
                window.location.href    = '/adm_panel/beer';
            });
        });
    });
</script>