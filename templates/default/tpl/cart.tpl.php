<? if ($aData) :?>
    <div class="modal fade" id="modal_send" tabindex="-1" role="dialog" aria-labelledby="modal_send_label">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_send_label">Оставить заявку</h4>
                </div>
                <div class="modal-body">
                    <form method="post" action="/cart/send" id="mesForm">
                        <div class="form-group">
                            <label for="inpName">Ваше имя:</label>
                            <input type="text" name="name" class="form-control" id="inpName" placeholder="Имя">
                            <p class="help-block error-block hide">Заполните поле</p>
                        </div>
                        <div class="form-group">
                            <label for="inpText">Содержание заявки:</label>
                            <div class="form-inline">
                                <div class="form-group" id="beerSelectPanel">
                                    <select id="beerSelect" class="form-control">
                                        <? foreach ($aData as $iKey => $aVal) :?>
                                            <option value="<?=$aVal['id']?>" data-img="<?=$aVal['image']?>" <?=$iKey==0?'selected="selected"':''?>><?=$aVal['title']?></option>
                                        <? endforeach;?>
                                    </select> 
                                    <button type="button" class="btn btn-success" id="beerAdd">добавить</button>
                                    <p class="help-block error-block hide">Выберите хотя бы одну позицию</p>
                                </div>
                            </div>
                            <div id="beerList" class="b-beerlist"></div>
                        </div>
                        <div class="form-group">
                            <label for="inpCont">Ваши комментарии к заказу и контактная информация:</label>
                            <textarea class="form-control" name="contact" id="inpCont" rows="5"></textarea>
                            <p class="help-block error-block hide">Заполните поле</p>
                            <p class="help-block">Пожалуйста, перечислите ваши контактные данные в поле выше, чтобы мы могли в скором времени связаться с вами</p>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" id="modalBtns">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Свернуть</button>
                    <button type="button" class="btn btn-primary" id="mesSend">Отправить</button>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>