<?php
namespace SSCE\Controllers;

class AdminBeer extends Admin {
    
    protected $_sTemplate   = 'admin_beer.php';
    
    public function indexAction(){
        parent::indexAction();
        
        if (isset($_GET['sort'])){
            if ($aData  = $this->db->selectRow("SELECT * FROM ?_sort WHERE id = ?d LIMIT 1;", $_GET['sort'])){
                $aData['date_e']    = date('d.m.Y', strtotime($aData['date_e']));
            }

            $this->setLayout('ajax_layout_json.php');
            $this->view->assign('mRequest', $aData);
        }
        
        if (isset($_POST['id']) && !$_POST['id']){
            if ($iId    = $this->db->query("INSERT INTO
                                ?_sort
                            SET
                                title   = ?,
                                title_sub    = ?,
                                text    = ?,
                                date_e  = ?,
                                color   = ?,
                                image   = ?,
                                type    = ?,
                                og      = ?,
                                abv     = ?,
                                ibu     = ?,
                                available   = ?d",
                            trim($_POST['title']),
                            trim($_POST['title_sub']),
                            trim($_POST['text']),
                            date('Y-m-d', strtotime($_POST['date_e'])),
                            trim($_POST['color']),
                            '',
                            $_POST['type'],
                            trim($_POST['og']),
                            trim($_POST['abv']),
                            trim($_POST['ibu']),
                            $_POST['available'])){
                $this->view->assign('sSuccess', 'Успешно добавлено');
            } else {
                $this->view->assign('sError', 'Ошибка при добавлении, проверьте правильность ввода');
            }
        }
        
        $aData  = $this->db->select("SELECT * FROM ?_sort ORDER BY `sort` ASC;");
        
        $this->view->assign('sMenuActive',  'beer');
        $this->view->assign('aData',        $aData);
    }
}