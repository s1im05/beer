<?php
namespace SSCE\Controllers;

abstract class Base extends \SSCE\Base {
    
    private $_sActionSuffix = 'Action';

    protected $_sAction     = 'index';    
    protected $_sTitle      = '';
    protected $_sLayout     = 'index.php';
    protected $_sTemplate   = 'template.php';
    
    
    public function getTitle(){
        return $this->_sTitle;
    }
    
    public function setTitle($sTitle){
        $this->_sTitle  = $sTitle;
        return $this;
    }
    
    public function setTemplate($sTemplate){
        $this->_sTemplate  = $sTemplate;
        return $this;
    }
    
    public function getTemplate(){
        return $this->_sTemplate;
    }
    
    public function setLayout($sLayout){
        $this->_sLayout  = $sLayout;
        return $this;
    }
    
    public function getLayout(){
        return $this->_sLayout;
    }
}