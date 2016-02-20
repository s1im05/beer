<p>
    <button class="btn btn-success" id="add_address">Добавить адрес</button>
    <button class="btn btn-default hidden" id="save_order">Сохранить порядок</button>
</p>
<? if ($aData) :?>
    <div id="sortable">
    <? foreach ($aData as $aBeer) :?>
        <div class="panel panel-default sortable" data-id="<?=$aBeer['id']?>">
            <div class="panel-heading">
                <?=$aBeer['title']?>
            </div>
            <div class="panel-body">
                <p><strong>Описание:</strong> <?=$aBeer['text']?></p>
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
        
        $('#add_sort').on('click', function(e){
            e.preventDefault();
            //$("#addSortForm")[0].reset();
            //$("#addSortForm :input").trigger('change').trigger('input');
            //$('#addSort').modal();
        });
    });
</script>