<?php
namespace SSCE\Controllers;

class Admin extends Base {
    
    protected $_sLayout = 'admin.php';
    
    public function indexAction(){
        
        if (isset($_POST['login']) && isset($_POST['pass'])){
            sleep(2);
            $this->_login($_POST['login'], $_POST['pass']);
        }
        
        if (!$this->_isLogged()){
            $this->setLayout('admin_login.php');
            return;
        }
        
    }
    
    private function _isLogged(){
        return isset($_SESSION['adm_auth']);
    }
    
    private function _login($sLogin, $sPass){
        if ($sLogin === 'admin' && $sPass === 'pass'){
            $_SESSION['adm_auth']   = true;
            $this->request->refresh();
        } else {
            $this->view->assign('sError', 'Неправильный логин или пароль');
        }
    }
}