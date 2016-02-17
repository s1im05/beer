<?php
namespace {
    
    function __autoload($sClassName){
        $sIncludePath   = '';
        
        $aExploded  = explode('\\', $sClassName);
        if ($aExploded[0] === 'SSCE'){
            array_shift($aExploded);
            $sIncludePath   = __DIR__.'/'.strtolower(implode('/', $aExploded)).'.class.php';
        }

        if ($sIncludePath === '') {
            throw new Exception("Autoloader Exception: can't match {$sClassName}");
        } elseif (!file_exists($sIncludePath)) {
            throw new Exception("Autoloader Exception: file {$sIncludePath} not exists");
        } else {
            require_once $sIncludePath;
        }
    }
}

namespace SSCE {

    abstract class Base {
        
        protected $_oDb;
        protected $_oConfig;
        protected $_oRequest;
        protected $_oView;
        
        public function __construct($aObjects) {
            $this->_oDb         = $aObjects['db'];
            $this->_oConfig     = $aObjects['config'];
            $this->_oRequest    = $aObjects['request'];
            $this->_oView       = $aObjects['view'];
        }
        
        public function __get($sKey){
            switch ($sKey){
                case 'db': 
                    return $this->_oDb;
                case 'config': 
                    return $this->_oConfig;
                case 'request': 
                    return $this->_oRequest;
                case 'view': 
                    return $this->_oView;
                case 'options': 
                    return array(
                        'db'        => $this->_oDb,
                        'config'    => $this->_oConfig,
                        'request'   => $this->_oRequest,
                        'view'      => $this->_oView,
                    );
                default: 
                    return null;
            }
        }
    }
}