<?php
namespace SSCE;

class Request {
    
    private $_sPath         = '';
    private $_aParams       = array();
    private $_sController   = '';
    private $_sAction       = '';
    private $_sHeader       = '';
    
    public function __construct($aRoutes){
        if (in_array(strtolower( ini_get('magic_quotes_gpc')), array('1', 'on'))) {
            $_POST      = array_map('stripslashes', $_POST );
            $_GET       = array_map('stripslashes', $_GET );
            $_COOKIE    = array_map('stripslashes', $_COOKIE );
        }
        
        $aRequestUrl        = parse_url( $_SERVER['REQUEST_URI'] );
        $this->_sPath       = $aRequestUrl['path'];
        
        foreach ($aRoutes as $oVal){
            if (preg_match('/^'.$oVal->path.'(\/?|\?.+)?$/', $this->_sPath, $aMatch)){
                array_shift($aMatch);
                if (isset($oVal->params) && sizeof($oVal->params) > 0 && sizeof($aMatch) >= sizeof($oVal->params)){
                    foreach ($oVal->params as $iKey => $sName){
                        $this->_aParams[$sName]   = urldecode($aMatch[$iKey]);
                    }
                }
                $this->_sController = $oVal->controller;
                $this->_sAction     = $oVal->action;
                if (isset($oVal->header)) {
                    header($oVal->header);
                }
                break;
            }
        }
        
        
    }
    
    public function getPath() {
        return $this->_sPath;
    }
    
    public function getParams() {
        return $this->_aParams;
    }
    
    public function getController() {
        return $this->_sController;
    }

    public function getAction() {
        return $this->_sAction;
    }
    
    public function go404() {
        header('Location: /404');
        exit();
    }

    public function go($sUrl) {
        header('Location: '.$sUrl);
        exit();
    }

    public function refresh() {
        header('Location: '.substr($_SERVER['REQUEST_URI'],0,strpos($_SERVER['REQUEST_URI'],'?')));
        exit();
    }
}