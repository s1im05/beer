<?php
namespace SSCE\Models;

class Base extends \SSCE\Base {
    
    protected $_sTable;
    protected $_sIdField    = 'id';
    
    private $_aData = array();
 
    public function __set($sAttr, $mValue){
        switch ($sAttr) {
            case $this->_sIdField: 
                $this->_aData  = $this->db->selectRow("SELECT * FROM ?_".$this->_sTable." WHERE `".$this->_sIdField."`  = ?d LIMIT 1;", $mValue);
            break;
            default:
                $this->_aData[$sAttr]   = $mValue;
        }
    }
    
    public function __get($sAttr){
        $mGet   = parent::__get($sAttr);
        if ($mGet !== null) {
            return $mGet;
        }
        switch ($sAttr) {
            case 'data':
                return $this->_aData;
            break;
            default:
                if (isset($this->_aData[$sAttr])) {
                    return $this->_aData[$sAttr];
                } else {
                    trigger_error(
                        'Property "'.$sAttr.'" is undefined',
                        E_USER_NOTICE);
                    return null;
                }
        }
    }
}