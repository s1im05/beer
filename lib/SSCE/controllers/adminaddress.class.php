<?php
namespace SSCE\Controllers;

class AdminAddress extends Admin {
    
    protected $_sTemplate   = 'admin_address.php';
    
    public function indexAction(){
        parent::indexAction();
        
        if (isset($_GET['place'])){
            $aData  = $this->db->selectRow("SELECT * FROM ?_places WHERE id = ?d LIMIT 1;", $_GET['place']);
            
            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', $aData);
            return;
        }
        
        if (isset($_POST['pos']) && isset($_POST['id'])){
            $this->db->query("UPDATE LOW_PRIORITY ?_places SET `sort`   = ?d WHERE id = ?d LIMIT 1;", $_POST['pos'], $_POST['id']);
            
            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', 'true');
            return;
        }
        
        if (isset($_GET['delete']) && isset($_POST['id'])){
            $this->db->query("DELETE FROM ?_places WHERE id = ?d LIMIT 1;", $_POST['id']);
            
            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', 'true');
            return;
        }
        
        if (isset($_POST['id']) && !$_POST['id']){ // add beer
            if ($iId    = $this->db->query("INSERT INTO
                                ?_places
                            SET
                                title   = ?,
                                text    = ?,
                                address = ?,
                                map     = ?,
                                web     = ?,
                                phone   = ?",
                            trim($_POST['title']),
                            trim($_POST['text']),
                            trim($_POST['address']),
                            trim($_POST['map']),
                            trim($_POST['web']),
                            trim($_POST['phone']))){
                $this->view->assign('sSuccess', 'Успешно добавлено');
            } else {
                $this->view->assign('sError', 'Ошибка при добавлении, проверьте правильность ввода');
            }
        } elseif (isset($_POST['id']) && $_POST['id']){ // edit beer
            $this->db->query("UPDATE LOW_PRIORITY
                                            ?_places
                                        SET
                                            title   = ?,
                                            text    = ?,
                                            address = ?,
                                            map     = ?,
                                            web     = ?,
                                            phone   = ?
                                        WHERE
                                            id  = ?d
                                        LIMIT 1;",
                                        trim($_POST['title']),
                                        trim($_POST['text']),
                                        trim($_POST['address']),
                                        trim($_POST['map']),
                                        trim($_POST['web']),
                                        trim($_POST['phone']),
                                        $_POST['id']);
            $this->view->assign('sSuccess', 'Изменения сохранены');
        }
        
        
        $aData  = $this->db->select("SELECT * FROM ?_places ORDER BY sort ASC;");
        
        $this->view->assign('sMenuActive', 'address');
        $this->view->assign('aData', $aData);
    }
}