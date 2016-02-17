<?php
namespace SSCE\Controllers;

class AdminBeer extends Admin {
    
    protected $_sTemplate   = 'admin_beer.php';
    
    public function indexAction(){
        parent::indexAction();
        
        if (isset($_POST['add'])){
            //$this->db->query("INSERT INTO");
        }
        
        
        $this->view->assign('sMenuActive', 'beer');
    }
}