<?php
namespace SSCE;

class Config {
    
    private $_aData;
 
    public function __construct($sConfigFile){
        if (file_exists($sConfigFile)) {
            $this->_aData   = json_decode(file_get_contents($sConfigFile));
        } else {
            throw new Exception('Unable to load config file');
        }
    }

    public function __get($sKey){
        switch ($sKey) {
            case 'data':
                return $this->_aData;
            default:
            if (isset($this->_aData->$sKey)){
                return $this->_aData->$sKey;
            }
        }
    }
}