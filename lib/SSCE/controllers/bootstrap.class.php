<?php
namespace SSCE\Controllers;

class Bootstrap extends Base {
    
    public function run(){

        $oUser      = new \SSCE\Models\User($this->options);

        if (isset($_POST['token'])){
            $oUser->loginLoginza($_POST['token']);
        } elseif (!$oUser->isLogged()){
            $oUser->loginCookie();
        }
        
        if ($this->request->getPath() === '/logout'){
            $oUser->logout();
        }

        $this->view->assign('bIsLogged', $oUser->isLogged());
    }
}