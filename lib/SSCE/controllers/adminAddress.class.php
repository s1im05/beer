<?php
namespace SSCE\Controllers;

class AdminAddress extends Admin {
    
    protected $_sTemplate   = 'admin_address.php';
    
    public function indexAction(){
        parent::indexAction();
        
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
        
        
        $aData  = $this->db->select("SELECT * FROM ?_places ORDER BY sort ASC;");
        
        $this->view->assign('sMenuActive', 'address');
        $this->view->assign('aData', $aData);
    }
}