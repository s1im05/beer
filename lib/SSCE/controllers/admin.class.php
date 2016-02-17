<?php
namespace SSCE\Controllers;

class Admin extends Base {
    
    protected $_sLayout     = 'admin.php';
    protected $_sTemplate   = 'admin_home.php';
    
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
    
    public function logoutAction(){
        unset($_SESSION['adm_auth']);
        $this->request->go('/adm_panel');
    }
    
    private function _isLogged(){
        return isset($_SESSION['adm_auth']);
    }
    
    private function _login($sLogin, $sPass){
        if ($sLogin === $this->config->project->login && md5($sPass.$this->config->project->salt) === $this->config->project->pass){
            $_SESSION['adm_auth']   = true;
            $this->request->refresh();
        } else {
            $this->view->assign('sError', 'Неправильный логин или пароль');
        }
    }
}