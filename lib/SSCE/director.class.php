<?php
namespace SSCE;

class Director extends Base {
    
    private $_aObjects;
    private $_sANameSuffix  = 'Action';

    
    public function __construct($aOptions){
        parent::__construct($aOptions);
        require_once 'helpers/controller.helper.php';
    }
    
    public function bootstrap() {
        $oBootstrap = new Controllers\Bootstrap($this->options);
        $oBootstrap->run();
        return $this;
    }
    
    public function runCurrent(){
        $sController    = $this->request->getController();
        if ($sController == '') {
            $this->request->go404();
        }
        $sCClass        = __NAMESPACE__.'\\Controllers\\'.ucfirst($sController);
        $sAction        = $this->request->getAction().$this->_sANameSuffix;

        try {
            $oController = new $sCClass($this->options);
            call_user_func_array(array($oController, $sAction), $this->request->getParams());
        } catch (Exception $e) {
            $this->request->go404();
        }
        
        echo $this->view
            ->setTemplate($oController->getTemplate())
            ->setLayout($oController->getLayout())
            ->setTitle($oController->getTitle())
            ->render();
    }
}