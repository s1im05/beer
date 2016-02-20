<p>
    <button class="btn btn-success" id="add_address">Добавить адрес</button>
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



<script type="text/javascript">
    $(function(){
        
        var btnDisable  = function(btn){
                $(btn).prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin" />&nbsp;');
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
        
        $('#add_sort').on('click', function(e){
            e.preventDefault();
            $("#addSortForm")[0].reset();
            $("#addSortForm :input").trigger('change').trigger('input');
            $('#addSort').modal();
        });
    });
</script>