<?php
namespace SSCE;

class View {
    
    protected $_sTemplate;
    protected $_sLayout;
    protected $_sTitle;
    protected $_aVars   = array();
    protected $_sTemplatePath;
    
    private $_sTemplateName = 'template';
    private $_sPathName     = 'path';
    private $_sTitleName    = 'title';
    
    
    public function __construct($sTemplatePath){
        $this->_sTemplatePath   = $sTemplatePath;
    }
    
    public function assign($sName, $mVal){
        $this->_aVars[$sName]   = $mVal;
        return $this;
    }
    
    public function getVar($sName){
        return isset($this->_aVars[$sName]) ? $this->_aVars[$sName] : null;
    }
    
    public function render(){
        ob_end_flush();
        $this->assign($this->_sPathName,    $this->_sTemplatePath);
        $this->assign($this->_sTitleName,   $this->getTitle());
        $this->assign($this->_sTemplateName, '.'.$this->_sTemplatePath.'/tpl/'.$this->getTemplate());
        foreach($this->_aVars as $sName => $mVal){
            $$sName = $mVal;
        }
        ob_start();
        error_reporting(0);
        require_once 'helpers/view.helper.php';
        require '.'.$this->_sTemplatePath.'/tpl/'.$this->getLayout();
        $aData  = ob_get_contents();
        ob_clean();
        error_reporting(E_ALL ^ E_DEPRECATED);
        return $aData;
    }
    
    
    public function setTemplate($sTemplate){
        $this->_sTemplate = $sTemplate;
        return $this;
    }
    
    public function getTemplate(){
        return $this->_sTemplate;
    }
    
    public function setTitle($sTitle){
        $this->_sTitle = $sTitle;
        return $this;
    }
    
    public function getTitle(){
        return $this->_sTitle;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout = $sLayout;
        return $this;
    }
    
    public function getLayout(){
        return $this->_sLayout;
    }
}