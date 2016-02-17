<?php
namespace SSCE\Controllers;

class AdminAddress extends Admin {
    
    protected $_sTemplate   = 'admin_address.php';
    
    public function indexAction(){
        parent::indexAction();
        
        
        
        $this->view->assign('sMenuActive', 'address');
    }
}