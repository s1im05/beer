<?php
namespace SSCE\Controllers;

class Index extends Base {
    
    protected $_sTemplate   = 'index.tpl.php';
    
    public function indexAction(){
        $aData  = $this->db->select("SELECT * FROM ?_sort WHERE `show` = 1 ORDER BY `sort` ASC;");

        $this->view->assign('aData',        $aData);
    }
}