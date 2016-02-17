<?php
class Error_Controller extends Controller {
    
    public function indexAction(){
        $aPath = $this->request->getPath();
        switch ($aPath[0]) {
            case '403':
                $this->error403Action();
            break;
            case '404':
                $this->error404Action();
            break;
            default:
                $this->errorAction();
        }
    }
    
    public function error403Action(){
        echo '403 Forbidden';
    }
    
    public function error404Action(){
        $this->setLayout('error404.php');
    }
    
    public function errorAction(){
        echo 'Unknown Error';
    }
}