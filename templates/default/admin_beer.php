<p>
    <button class="btn btn-success" data-toggle="modal" data-target="#addSort">Добавить сорт</button>
    <button class="btn btn-default hidden" id="save_order">Сохранить порядок</button>
    
</p>
<? if ($aData) :?>
    <div id="sortable">
    <? foreach ($aData as $aBeer) :?>
        <div class="panel panel-default sortable" data-id="<?=$aBeer['id']?>">
            <div class="panel-heading"><?=$aBeer['title']?></div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    <? endforeach?>
    </div>
<? else :?>
    <p>Нет данных для отображения</p>
<? endif;?>


<div class="modal fade" tabindex="-1" role="dialog" id="addSort">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Добавить сорт</h4>
            </div>
            <div class="modal-body">
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
                    <input type="file" name="image" required="required" id="image">
                </div>
                <div class="form-group form-inline">
                    <label for="color">Цвет поля под обложкой</label>
                    <div class="bfh-colorpicker" data-name="color"></div>
                </div>
                <div class="form-group">
                    <label>Тип пива для отображения</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="type" value="light" checked="checked">
                            светлое
                        </label>
                        &nbsp;
                        <label>
                            <input type="radio" name="type" value="red">
                            красное
                        </label>
                        &nbsp;
                        <label>
                            <input type="radio" name="type" value="dark">
                            темное
                        </label>
                    </div>
                </div>                
                <div class="form-group">
                    <label>Имеется в наличии</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="available" value="1" checked="checked">
                            имеется
                        </label>
                    </div>
                    <div class="radio form-inline">
                        <label>
                            <input type="radio" name="available" value="0">
                            ожидается <span id="date_e" class="hidden"><input type="text" class="form-control" id="date_e_input" name="date_e" value="<?=date('d.m.Y')?>"></span>
                        </label>
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
                <button type="submit" name="add" class="btn btn-primary">Добавить</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
            </div>
        </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(':radio[name=available]').on('change', function(e){
            $(':radio[name=available]:checked').val() === '1' ? $('#date_e').addClass('hidden') : $('#date_e').removeClass('hidden');
        });
        
        $('#date_e_input').datepicker({
            'dateFormat': 'dd.mm.yy',
            'firstDay': 1
        });
        
        $("#sortable").sortable({
            'stop': function(){
                $('#save_order').removeClass('hidden');
            }
        });
        
        $('#save_order').on('click', function(e){
            e.preventDefault();
            $(this).prop('disabled', true).prepend('<i class="fa fa-spinner fa-spin" />&nbsp;');
        });
    });
</script>


















